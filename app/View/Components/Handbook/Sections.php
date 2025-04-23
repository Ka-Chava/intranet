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
        $tags = collect(['Introductory Statement', 'Employment', 'Employment Status and Records']);

        $articles = \App\Models\BlogPost::query()
            ->whereHas('blog', function ($query) {
                $query->where('slug', 'handbook');
            })
            ->withAnyTags($tags)
            ->get();

        $sections = $tags->mapWithKeys(function ($tag) use ($articles) {
            $matchedPosts = $articles->filter(function ($article) use ($tag) {
                return $article->tags->contains('name', $tag);
            });

            return [
                $tag => (object) [
                    'title' => $tag,
                    'description' => 'Lorem ipsum dolor sit amet elit sed do eiusmod',
                    'articles' => $matchedPosts
                ]
            ];
        });

        return view('components.handbook.sections', [
            'sections' => $sections
        ]);
    }
}
