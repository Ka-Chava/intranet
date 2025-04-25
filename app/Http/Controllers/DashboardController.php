<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     */
    public function show(): View
    {
        // TODO: mocks
        $resources = (object) [
            'title' => 'Resources',
            'size' => 'small',
            'articles' => [
                (object) [
                    'title' => 'Hanbook & Policies',
                    'url' => '/my'
                ],
                (object) [
                    'title' => 'Helpdesk',
                    'url' => '/my'
                ],
                (object) [
                    'title' => 'ADP',
                    'url' => '/my'
                ],
                (object) [
                    'title' => '401K',
                    'url' => '/my'
                ],
                (object) [
                    'title' => '401K',
                    'url' => '/my'
                ]
            ]
        ];

        $news = \App\Models\Blog::query()
            ->withAnyTags(['dashboard'])
            ->with(['articles' => function ($query) {
                $query->orderByDesc('published_at')->limit(10);
            }])
            ->get();

        $resources = [
            $resources,
            ...$news,
        ];

        return view('dashboard', [
            'resources' => $resources
        ]);
    }
}
