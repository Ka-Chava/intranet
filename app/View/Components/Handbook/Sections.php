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
        $titles = collect(['Introductory Statement', 'Employment', 'Employment Status and Records']);
        $blogs = \App\Models\Blog::query()->withAnyTags(['handbook'])->get();

        $sections = $blogs->sortBy(function ($blog) use ($titles) {
            $index = $titles->search($blog->title);
            return $index !== false ? $index : PHP_INT_MAX;
        });

        return view('components.handbook.sections', [
            'sections' => $sections
        ]);
    }
}
