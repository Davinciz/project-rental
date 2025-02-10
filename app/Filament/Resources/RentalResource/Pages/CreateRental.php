<?php

namespace App\Filament\Resources\RentalResource\Pages;

use App\Filament\Resources\RentalResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\Console;
use App\Models\HistoryRental;
use App\Models\Rental;
use App\Models\Television;

class CreateRental extends CreateRecord
{
    protected static string $resource = RentalResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $console = Console::find($data['console_id']);
        $television = Television::find($data['television_id']);

        if ($console && $console->status === 'not_available') {
            Notification::make()
                ->title('Console Not Available for Now')
                ->body('The selected console is currently not available for rental.')
                ->danger()
                ->send();

            // Batalkan penyimpanan
            $this->halt();
        }

         // Validasi untuk Television
        if ($television && $television->status_television === 'not_available') {
            Notification::make()
                ->title('Television Not Available for Now')
                ->body('The selected television is currently not available for rental.')
                ->danger()
                ->send();

            // Batalkan penyimpanan
            $this->halt();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $rental = $this->record;

        // Ubah status console
        if ($rental->console_id) {
            Console::where('id', $rental->console_id)->update(['status' => 'not_available']);
        }

        // Ubah status television
        if ($rental->television_id) {
            Television::where('id', $rental->television_id)->update(['status_television' => 'not_available']);
        }
    }

    protected function afterSave(): void
    {
        dd('CreateRental afterSave called', $this->record->toArray()); // Debugging

        \App\Models\HistoryRental::create([
            'user_id' => $this->record->user_id,
            'rental_id' => $this->record->id,
            'console_id' => $this->record->console_id,
            'television_id' => $this->record->television_id,
            'start_date' => $this->record->start_date,
            'end_date' => $this->record->end_date,
    ]);
    }
}
