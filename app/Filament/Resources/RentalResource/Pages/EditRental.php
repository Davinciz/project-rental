<?php

namespace App\Filament\Resources\RentalResource\Pages;

use App\Filament\Resources\RentalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Console;
use App\Models\Television;
use Illuminate\Validation\ValidationException;

class EditRental extends EditRecord
{
    protected static string $resource = RentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $console = Console::find($data['console_id']);
        $television = Television::find($data['television_id']);

        if ($console && $console->status === 'not_avalaible') {
            throw ValidationException::withMessages([
                'console_id' => 'The selected console is not available for rental.',
            ]);
        }

        if ($television && $television->status_television === 'not_avalaible') {
            throw ValidationException::withMessages([
                'television_id' => 'The selected television is not available for rental.',
            ]);
        }

        return $data;
    }

}
