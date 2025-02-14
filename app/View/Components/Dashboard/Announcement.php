<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Announcement as AnnouncentModel;

class Announcement extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $announcement = AnnouncentModel::latest()->first();

        return view('components.dashboard.announcement', ['announcement' => $announcement]);
    }
}
