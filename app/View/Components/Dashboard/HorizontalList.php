<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HorizontalList extends Component
{
    public $items;
    public $heading;

    public function __construct($items = [], $heading = null)
    {
        $this->items = $items;
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.horizontal-list');
    }
}
