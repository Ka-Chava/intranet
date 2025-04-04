<?php

namespace App\View\Components\Helpdesk;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Category extends Component
{
    public $category;

    /**
     * Create a new component instance.
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.helpdesk.category');
    }
}
