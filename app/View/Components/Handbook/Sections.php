<?php

namespace App\View\Components\Handbook;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sections extends Component
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
        return view('components.handbook.sections', [
            'sections' => array(
                (object) [
                    'title' => 'Introductory Statement',
                    'description' => 'Lorem ipsum dolor sit amet elit sed do eiusmod',
                    'posts' => []
                ],
                (object) [
                    'title' => 'Employment',
                    'description' => 'Lorem ipsum dolor sit amet elit sed do eiusmod',
                    'posts' => [
                        (object) [
                            'id' => 1,
                            'title' => 'Nature of Employment',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 2,
                            'title' => 'Employee Relations',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 3,
                            'title' => 'Equal Employment Opportunity',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 4,
                            'title' => 'Conflicts of Interest',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 5,
                            'title' => 'Outside Employment',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 6,
                            'title' => 'Employee Discount',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 7,
                            'title' => 'Receiving Gifts',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 8,
                            'title' => 'Non-Disclosure',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 9,
                            'title' => 'Disability Accommodation',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 10,
                            'title' => 'ADA Open Door Policy',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 11,
                            'title' => 'Job Posting',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ]
                    ]
                ],
                (object) [
                    'title' => 'Employment Status and Records',
                    'description' => 'Lorem ipsum dolor sit amet elit sed do eiusmod',
                    'posts' => [
                        (object) [
                            'id' => 12,
                            'title' => 'Employment Categories',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 13,
                            'title' => 'Personnel Data CHanges',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 14,
                            'title' => 'Performance Evaluation',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                        (object) [
                            'id' => 15,
                            'title' => 'Salary Administration',
                            'content' => 'The Handbook was developed to describe some of the expectations of our employees and outline the policies, programs, and benefits available to you. You should familiarize yourself with the contents of the Handbook as soon as possible.'
                        ],
                    ]
                ],
            )
        ]);
    }
}
