<?php

namespace App\View\Components\Store;

use Illuminate\View\Component;
use Illuminate\View\View;

class Header extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.store.header');
    }
}
