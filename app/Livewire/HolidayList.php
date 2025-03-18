<?php

namespace App\Livewire;

use App\Models\Holiday;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class HolidayList extends Component
{
    public $holidays;
    public $holidaysRange = 30;
    public $holidaysCount = 0;
    public $dismissedHolidays;
    public $class;

    public function mount()
    {
        $this->dismissedHolidays = session()->get('dismissed_holidays', []);
        $this->loadHolidays();
    }

    public function render()
    {
        return view('livewire.holiday-list');
    }

    public function loadHolidays()
    {
        $startOfDay = now()->startOfDay();
        $endOfRange = $startOfDay->copy()->addDays($this->holidaysRange);

        try {
            $holidays = Holiday::where('date', '<=', $endOfRange)
                ->whereNotIn('id', $this->dismissedHolidays)
                ->orderBy('date', 'asc')
                ->get();

            $this->holidaysCount = $holidays->count();

            $this->holidays = $holidays->take(3)->map(function ($holiday) use ($startOfDay) {
                $holiday->until = ceil(abs(
                    Carbon::parse($holiday->date)
                        ->startOfDay()
                        ->diffInDays($startOfDay)
                ));

                return $holiday;
            });
        } catch (\Exception $e) {
            Log::error('Error loading holidays: ' . $e->getMessage());
            $this->holidays = collect();
        }
    }

    public function dismiss($holidayId)
    {
        $dismissed = session()->get('dismissed_holidays', []);
        $dismissed[] = $holidayId;
        session()->put('dismissed_holidays', array_unique($dismissed));

        $this->dismissedHolidays = $dismissed;

        $this->loadHolidays();
    }

    #[On('holidays-range-changed')]
    public function changeRange($value)
    {
        $this->holidaysRange = $value;

        $this->loadHolidays();
    }
}
