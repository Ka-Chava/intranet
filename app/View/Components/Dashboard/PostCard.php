<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    public $post;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($post, $size = 'default')
    {
        $this->post = $post;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.post-card');
    }
}
