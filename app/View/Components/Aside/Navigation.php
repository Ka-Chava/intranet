<?php

namespace App\View\Components\Aside;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public array $links;

    /**
     * Create a new component instance.
     */
    public function __construct(array $links = [])
    {
        $this->links = $links ?: [
            ['url' =>'dashboard', 'title' => 'Dashboard', 'icon' => 'grid'],
            ['url' =>'handbook', 'title' => 'Handbook', 'icon' => 'file'],
            ['url' =>'https://www.adp.com', 'title' => 'Company News', 'icon' => 'apartment'],
            ['url' =>'https://www.adp.com', 'title' => 'Help Desk', 'icon' => 'laptop'],
            ['url' =>'https://www.adp.com', 'title' => 'I.T. News', 'icon' => 'database'],
            ['url' =>'https://www.adp.com', 'title' => 'ADP', 'icon' => 'adp'],
            ['url' =>'http://kachava.dash.app', 'title' => '401k', 'icon' => 'wallet'],
            ['url' =>'http://kachava.dash.app', 'title' => 'Dash', 'icon' => 'dash'],
            ['url' =>'store', 'title' => 'Employee Store', 'icon' => 'cart'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.aside.navigation');
    }
}
