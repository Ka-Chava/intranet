<?php

namespace App\View\Components\Aside;

use Illuminate\View\Component;
use Illuminate\View\View;

class SideNav extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.aside.side-nav');
    }
}
