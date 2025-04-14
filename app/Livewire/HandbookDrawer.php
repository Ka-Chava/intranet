<?php

namespace App\Livewire;

use Livewire\Component;

class HandbookDrawer extends Component
{
    public function render()
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

        return view('livewire.handbook-drawer', [
            'sections' => $sections
        ]);
    }
}

