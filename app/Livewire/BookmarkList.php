<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookmarkList extends Component
{
    protected $listeners = ['refresh-bookmarks' => '$refresh'];

    public function render()
    {
        $user = Auth::user();

        return view('livewire.bookmark-list', [
            'bookmarks' => $user->bookmarks
        ]);
    }
}
