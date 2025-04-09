<?php

namespace App\View\Components\Blog;

use App\Models\BlogPost;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogPostMeta extends Component
{
    public BlogPost | null $article;

    /**
     * Create a new component instance.
     */
    public function __construct($article = null)
    {
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog.blog-post-meta');
    }
}
