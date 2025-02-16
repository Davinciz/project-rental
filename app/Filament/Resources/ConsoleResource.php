<?php 

namespace App\Filament\Resources;

use App\Filament\Resources\ConsoleResource\Pages;
use App\Models\Console;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsoleResource extends Resource
{
    protected static ?string $model = Console::class;

    protected static ?string $navigationIcon = 'heroicon-s-play-circle';
    protected static ?string $navigationGroup = 'Unit';
    protected static ?string $navigationLabel = 'Playstation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Console Name')
                    ->required(),

                TextInput::make('description')
                    ->label('Description'),

                TextInput::make('price_console')
                    ->label('Price Per Day')
                    ->numeric()
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Available',
                        'not_available' => 'Not Available',])
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->directory('consoles')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('price_console')
                    ->label('Price/Day')
                    ->money('IDR', true),
                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(function ($state) {
                        return $state === 'available' 
                            ? 'Available' 
                            : 'Not Available';
                    })
                    ->icon(function ($state) {
                        return $state === 'available' 
                            ? 'heroicon-o-check-circle' 
                            : 'heroicon-o-x-circle';
                    })
                    ->iconColor(function ($state) {
                        return $state === 'available' 
                            ? 'success' 
                            : 'danger';
                    }),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsoles::route('/'),
            'create' => Pages\CreateConsole::route('/create'),
            'edit' => Pages\EditConsole::route('/{record}/edit'),
        ];
    }
}
