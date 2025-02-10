<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentalResource\Pages;
use App\Filament\Resources\RentalResource\RelationManagers;
use Filament\Notifications\Notification;
use App\Models\Console;
use App\Models\Rental;
use App\Models\Television;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RentalResource extends Resource
{
    protected static ?string $model = Rental::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Rental';

    public static function form(Form $form): Form   
    {
        return $form
            ->schema([
                // Select untuk Console
                Select::make('console_id')
                    ->label('Console')
                    ->relationship('console', 'name')
                    ->required()
                    ->reactive()
                    ->options(function () {
                        // Ambil semua console dengan nama dan status
                        return Console::all()->mapWithKeys(function ($console) {
                            $label = $console->name;
                            if ($console->status === 'not_available') {
                                $label .= ' (Not Available)';
                            }
                            return [$console->id => $label];
                        });
                        }),
                        
                    

                // Select untuk Television
                Select::make('television_id')
                    ->label('Television')
                    ->relationship('television', 'model')
                    ->nullable()
                    ->prefix('Opsional')
                    ->reactive()
                    ->options(function () {
                        // Ambil semua television dengan model dan status
                        return Television::all()->mapWithKeys(function ($television) {
                            $label = $television->model;
                            if ($television->status_television === 'not_available') {
                                $label .= ' (Not Available)';
                            }
                            return [$television->id => $label];
                        });
                    }),

                TextInput::make('rent_day')
                    ->label('Rental Time (days)')
                    ->numeric()
                    ->reactive()
                    ->required()
                    ->minValue(1)
                    ->maxValue(3)
                    ->afterStateUpdated(function (callable $set, $state, $get) {
                        $console = Console::find($get('console_id'));
                        $television = Television::find($get('television_id'));
                        
                        $consolePrice = $console ? $console->price_console : 0; // Harga console
                        $televisionPrice = $television ? $television->price_television : 0; // Harga television
                
                        if ($state) {
                            $totalPrice = ($consolePrice + $televisionPrice) * $state;
                            $set('total_price', $totalPrice); // Set total harga
                        }
                        }),

                DatePicker::make('start_date')
                ->label('Start Date')
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    $rentDays = (int) $get('rent_day');

                    if ($state && is_numeric($rentDays)) {
                        $endDate = \Carbon\Carbon::parse($state)->addDays((int) $rentDays);
                        $set('end_date', $endDate->toDateString());
                    }
                }),
                
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->readOnly(),

                TextInput::make('total_price')
                        ->label('Total Price')
                        ->prefix('Rp')
                        ->readOnly(),

                TextInput::make('code')
                ->label('Unique ID')
                ->disabled()
                ->dehydrated()
                ->default(fn () => 'ID-' . strtoupper(Str::random(8))),

Forms\Components\Hidden::make('user_id')
                        ->default(Auth::id())
                        ->required(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                ->label('Unique ID')
                ->searchable(),
                TextColumn::make('console.name'),
                TextColumn::make('television.model'),
                TextColumn::make('rent_day'),
                TextColumn::make('start_date')
                    ->label('Start Rent')
                    ->date('d-m-Y'),
                TextColumn::make('end_date')
                    ->label('End Rent')
                    ->date('d-m-Y'),
                TextColumn::make('total_price')
                ->money('IDR', true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('accept')
                ->label('Return')
                ->requiresConfirmation()
                ->color('success')
                ->sendSuccessNotification(
                    )
                ->action(function (Rental $record) {
                    if ($record->console) {
                        $record->console->update(['status' => 'available']);
                    }
                    if ($record->television) {
                        $record->television->update(['status_television' => 'available']);
                    }
                    // Hapus data rental
                    $record->delete();

                Notification::make()
                ->title('Thank You')
                ->body('Thank you for returning.')
                ->success()
                ->send();
                
                }),
                
                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

   /**
     * Filter data agar customer hanya bisa melihat riwayat miliknya sendiri.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth::check() && auth::user()->hasRole('customer')) {
            return $query->where('user_id', auth::id());
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentals::route('/'),
            'create' => Pages\CreateRental::route('/create'),
            'edit' => Pages\EditRental::route('/{record}/edit'),
        ];
    }
}
