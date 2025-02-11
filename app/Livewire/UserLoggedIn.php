<?php

namespace App\Livewire;

use Illuminate\View\Component;
use Illuminate\View\View;

class UserLoggedIn extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.aside.user-logged-in');
    }
}
