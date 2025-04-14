<?php

namespace App\Livewire;

use App\Contracts\IBookmarkable;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class BookmarkButton extends Component
{
    public $class = '';

    public $bookmarked = false;

    public $hideNonBookmarked = false;

    #[Reactive]
    public ?IBookmarkable $bookmarkable = null;

    protected $listeners = ['refresh-bookmarks' => '$refresh'];

    public function render()
    {
        return view('livewire.bookmark-button');
    }

    public function toggle()
    {
        if (Auth::check() && isset($this->bookmarkable)) {
            $this->bookmarked = $this->bookmarkable->toggleBookmark(Auth::user());
            $this->dispatch('refresh-bookmarks');
            $this->dispatch("refresh-bookmark.{$this->bookmarkable->id}", bookmarked: $this->bookmarked);
        }
    }

    #[On('refresh-bookmark.{bookmarkable.id}')]
    public function onRefreshBookmarks($bookmarked)
    {
        $this->bookmarked = $bookmarked;
    }
}
