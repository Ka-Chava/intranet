<?php

namespace App\View\Components\Helpdesk;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.helpdesk.category-list', [
            'categories' => [
                (object)[
                    'name' => 'Common Requests',
                    'description' => 'Get IT help, Set up VPN to the office, Request a new account, Report a system problem, Report broken hardware',
                    'requests' => [
                        (object)[
                            'id' => 1,
                            'icon' => 'bot',
                            'name' => 'Get IT help',
                            'description' => 'Get assistance for general IT problems',
                        ],
                        (object)[
                            'id' => 2,
                            'icon' => 'heroicon-o-shield-check',
                            'name' => 'Set up VPN to the office',
                            'description' => 'Want to access work stuff from outside? Let us know',
                        ],
                        (object)[
                            'id' => 3,
                            'icon' => 'heroicon-o-user',
                            'name' => 'Request a new account',
                            'description' => 'Request a new account for a system',
                        ],
                        (object)[
                            'id' => 4,
                            'icon' => 'heroicon-o-bell',
                            'name' => 'Report a system problem',
                            'description' => 'Let us know if something isn’t working properly and we’ll aim to get it back up and running quickly',
                        ],
                        (object)[
                            'id' => 5,
                            'icon' => 'laptop',
                            'name' => 'Report broken hardware',
                            'description' => 'Report hardware that might be faulty or broken, e.g. a broken computer screen or a damaged server',
                        ]
                    ]
                ],
                (object)[
                    'name' => 'Computers',
                    'description' => 'Get IT help, Request new software, Report broken hardware, Request new hardware',
                    'requests' => [
                        (object)[
                            'id' => 1,
                            'icon' => 'bot',
                            'name' => 'Get IT help',
                            'description' => 'Get assistance for general IT problems',
                        ],
                        (object)[
                            'id' => 2,
                            'icon' => 'heroicon-o-shield-check',
                            'name' => 'Set up VPN to the office',
                            'description' => 'Want to access work stuff from outside? Let us know',
                        ],
                    ]
                ],
                (object)[
                    'name' => 'Logins and Accounts',
                    'description' => 'Offboard employee, Setup VPN to the office, Request admin access, Request a new account, Fix an account problem, Onboard new employee',
                    'requests' => [
                        (object)[
                            'id' => 1,
                            'icon' => 'bot',
                            'name' => 'Get IT help',
                            'description' => 'Get assistance for general IT problems',
                        ],
                        (object)[
                            'id' => 2,
                            'icon' => 'heroicon-o-shield-check',
                            'name' => 'Set up VPN to the office',
                            'description' => 'Want to access work stuff from outside? Let us know',
                        ],
                    ]
                ],
                (object)[
                    'name' => 'Applications',
                    'description' => 'Request new software, Report a system problem',
                    'requests' => [
                        (object)[
                            'id' => 1,
                            'icon' => 'bot',
                            'name' => 'Get IT help',
                            'description' => 'Get assistance for general IT problems',
                        ],
                        (object)[
                            'id' => 2,
                            'icon' => 'heroicon-o-shield-check',
                            'name' => 'Set up VPN to the office',
                            'description' => 'Want to access work stuff from outside? Let us know',
                        ],
                    ]
                ],
                (object)[
                    'name' => 'Servers and Infrastuctures',
                    'description' => 'Report a system problem, Report broken hardware',
                    'requests' => [
                        (object)[
                            'id' => 1,
                            'icon' => 'bot',
                            'name' => 'Get IT help',
                            'description' => 'Get assistance for general IT problems',
                        ],
                        (object)[
                            'id' => 2,
                            'icon' => 'heroicon-o-shield-check',
                            'name' => 'Set up VPN to the office',
                            'description' => 'Want to access work stuff from outside? Let us know',
                        ],
                    ]
                ]
            ],
        ]);
    }
}
