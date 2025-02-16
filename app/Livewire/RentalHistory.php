<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;

class RentalHistory extends Component
{
    public $historys;
    public $selectedRental = null;
    public $showDetailModal = false;

    public function mount()
    {
        $this->historys = Rental::with(['console', 'television'])->get();
    }

    public function showDetail($rentalId)
    {
        $this->selectedRental = Rental::with(['console', 'television'])->find($rentalId);
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->selectedRental = null;
    }

    public function render()
    {
        return view('livewire.rental-history', compact('historys'));
    }
}