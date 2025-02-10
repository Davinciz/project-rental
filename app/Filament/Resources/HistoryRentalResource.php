<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryRentalResource\Pages;
use App\Filament\Resources\HistoryRentalResource\RelationManagers;
use App\Models\HistoryRental;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Resources\Model;
use Filament\Tables;
use App\Models\User;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryRentalResource extends Resource
{
    protected static ?string $model = HistoryRental::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Rental';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('code')
                ->label('Unique ID'),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('console_id')
                    ->label('Console')
                    ->relationship('console', 'name')
                    ->nullable(),
                Select::make('television_id')
                    ->label('Television')
                    ->relationship('television', 'model')
                    ->nullable(),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->required(),
                TextInput::make('total_price')
                    ->label('Total Price'),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                ->label('Unique ID'),
                TextColumn::make('user.name')
                ->label('User'),
                TextColumn::make('console.name')
                    ->label('Console'),
                TextColumn::make('television.model')
                    ->label('Television'),
                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d-m-Y'),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('d-m-Y'),
                TextColumn::make('total_price')
                    ->label('Total Price')
                    ->money('IDR'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
                    
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth::user();

        // Hanya tampilkan data yang dibuat oleh user yang sedang login
        if ($user->hasRole('customer')) {
            return  $query->where('user_id', Auth::id());
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
            'index' => Pages\ListHistoryRentals::route('/'),
            'create' => Pages\CreateHistoryRental::route('/create'),
            'edit' => Pages\EditHistoryRental::route('/{record}/edit'),
        ];
    }
}
