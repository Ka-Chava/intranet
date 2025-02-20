<?php

namespace App\View\Components\Global;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.global.page-header');
    }
}
