<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TelevisionResource\Pages;
use App\Filament\Resources\TelevisionResource\RelationManagers;
use App\Models\Television;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\select;

class TelevisionResource extends Resource
{
    protected static ?string $model = Television::class;

    protected static ?string $navigationIcon = 'heroicon-m-computer-desktop';
    protected static ?string $navigationGroup = 'Unit';
    protected static ?string $navigationLabel = 'Television';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('model'),
                TextInput::make('price_television'),
                Select::make('status_television')
                    ->label('Status')
                    ->options([
                        'available' => 'Available',
                        'not_availaible' => 'Not Available',])
                    ->required(),
                
            ]);
                    
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model')
                    ->label('Model'),
                TextColumn::make('price_television')->label('Price/Day')
                    ->label('Price/Day')
                    ->money('IDR'),
                TextColumn::make('status_television')->label('Status')
                    ->formatStateUsing(function ($state) {
                        return $state === 'avalaible' 
                            ? 'Available' 
                            : 'Not Available';
                    })
                    ->icon(function ($state) {
                        return $state === 'avalaible' 
                            ? 'heroicon-o-check-circle' 
                            : 'heroicon-o-x-circle';
                    })
                    ->iconColor(function ($state) {
                        return $state === 'avalaible' 
                            ? 'success' 
                            : 'danger';
                }),
                

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTelevisions::route('/'),
            'create' => Pages\CreateTelevision::route('/create'),
            'edit' => Pages\EditTelevision::route('/{record}/edit'),
        ];
    }
}
