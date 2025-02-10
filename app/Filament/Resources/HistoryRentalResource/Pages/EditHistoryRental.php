<?php

namespace App\Filament\Resources\HistoryRentalResource\Pages;

use App\Filament\Resources\HistoryRentalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryRental extends EditRecord
{
    protected static string $resource = HistoryRentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
