<?php

namespace App\Livewire;

use Livewire\Component;

class HandbookDrawer extends Component
{
    public function render()
    {
        $titles = collect(['Introductory Statement', 'Employment', 'Employment Status and Records']);
        $blogs = \App\Models\Blog::query()->withAnyTags(['handbook'])->get();

        $sections = $blogs->sortBy(function ($blog) use ($titles) {
            $index = $titles->search($blog->title);
            return $index !== false ? $index : PHP_INT_MAX;
        });

        return view('livewire.handbook-drawer', [
            'sections' => $sections
        ]);
    }
}

