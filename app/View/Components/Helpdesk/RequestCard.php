<?php

namespace App\View\Components\Helpdesk;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RequestCard extends Component
{
    public $request;

    /**
     * Create a new component instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.helpdesk.request-card');
    }
}
