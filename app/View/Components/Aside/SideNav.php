<?php

namespace App\View\Components\Aside;

use Illuminate\View\Component;
use Illuminate\View\View;

class SideNav extends Component
{
    public string $position;

    public function __construct(string $position = 'left')
    {
        $this->position = $position;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.aside.side-nav');
    }
}
