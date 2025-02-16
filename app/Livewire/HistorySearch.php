<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\HistoryRental;

class HistorySearch extends Component
{
    public $search = '';

    public function render()
    {
        $histories = HistoryRental::where('code', 'like', '%' . $this->search . '%')
            ->orWhereHas('console', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.history-search', compact('histories'));
    }
}
