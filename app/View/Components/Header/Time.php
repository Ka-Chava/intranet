<?php

namespace App\View\Components\Header;

use Illuminate\View\Component;
use Illuminate\View\View;

class Time extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.header.time');
    }
}
