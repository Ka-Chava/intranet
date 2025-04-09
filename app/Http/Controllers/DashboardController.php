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
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'Helpdesk',
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'ADP',
                    'slug' => '/'
                ],
                (object) [
                    'title' => '401K',
                    'slug' => '/'
                ],
                (object) [
                    'title' => '401K',
                    'slug' => '/'
                ]
            ]
        ];

        $itNews = (object) [
            'title' => 'I.T. News',
            'articles' => [
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'slug' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'slug' => '/'
                ]
            ]
        ];

        $news = \App\Models\Blog::query()
            ->where('slug', '=', 'company-news')
            ->with(['articles' => function ($query) {
                $query->orderByDesc('published_at')->limit(10);
            }])
            ->firstOrFail();

        $resources = [
            $resources,
            $news,
            $itNews
        ];

        return view('dashboard', [
            'resources' => $resources
        ]);
    }
}
