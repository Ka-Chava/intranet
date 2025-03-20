<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use Carbon\Carbon;
use Livewire\Component;

class Announcement extends Component
{
    public function render()
    {
        $hasAnnouncements = false;

        $dismissed = session()->get('dismissed_announcements', []);
        $reminded = collect(session()->get('reminded_announcements', []))
            ->filter(fn($timestamp) => Carbon::now()->timestamp < $timestamp)
            ->keys()
            ->toArray();

        $announcement = AnnouncementModel::whereNotIn('id', $dismissed)
            ->whereNotIn('id', $reminded)
            ->orderBy('created_at', 'asc')
            ->first();

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
        $dismissed = session()->get('dismissed_announcements', []);
        $dismissed[] = $id;
        session()->put('dismissed_announcements', array_unique($dismissed));
    }

    public function remind(string $id)
    {
        $reminded = session()->get('reminded_announcements', []);
        $reminded[$id] = Carbon::now()->addDay()->timestamp;
        session()->put('reminded_announcements', $reminded);
    }
}
