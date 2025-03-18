<?php

namespace App\Livewire;

use Livewire\Component;

class Calendar extends Component
{
    public $selectedDate;
    public $class;

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function updatedSelectedDate()
    {
        // TODO: so something
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
