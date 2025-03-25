<?php

namespace App\Livewire;

use App\Models\Holiday;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public $selectedDate;
    public $holidays;
    public $class;

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
        $this->loadHolidays();
    }

    public function loadHolidays()
    {
        $date = Carbon::parse($this->selectedDate);
        $this->holidays = Holiday::whereMonth('date', $date->month)
            ->whereYear('date', $date->year)
            ->get();
    }

    public function updateSelectedDate($date)
    {
        $this->selectedDate = $date;
        $this->loadHolidays();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
