<?php

namespace App\Filament\Resources\HistoryRentalResource\Pages;

use App\Filament\Resources\HistoryRentalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoryRentals extends ListRecords
{
    protected static string $resource = HistoryRentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
