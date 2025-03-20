<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use Livewire\Component;

class Announcement extends Component
{
    public function render()
    {
        $announcement = AnnouncementModel::latest()->first();
        $hasAnnouncements = false;

        if($announcement) {
            $hasAnnouncements = true;
        }

        return view('livewire.announcement')->with([
            'hasAnnouncements' => $hasAnnouncements,
            'announcement' => $announcement
        ]);
    }

    public function dismiss(string $id)
    {
        // TODO: Add implementation
    }

    public function remind(string $id)
    {
        // TODO: Add implementation
    }
}
