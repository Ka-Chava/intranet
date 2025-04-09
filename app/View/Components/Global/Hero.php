<?php

namespace App\View\Components\Global;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public $title;
    public $image;
    public $tagline;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $image = null, $tagline = null)
    {
        $this->title = $title;
        $this->image = $image;
        $this->tagline = $tagline;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.global.hero');
    }
}
