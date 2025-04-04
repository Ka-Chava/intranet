<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $id;
    public $title;
    public $showCloseButton;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $title = null, $showCloseButton = false)
    {
        $this->id = $id;
        $this->title = $title;
        $this->showCloseButton = $showCloseButton;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.modal');
    }
}
