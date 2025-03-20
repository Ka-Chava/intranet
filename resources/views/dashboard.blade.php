<x-app-layout>
    <livewire:announcement />

    @php
        $resources = (object) [
            'name' => 'Resources',
            'posts' => [
                (object) [
                    'title' => 'Hanbook & Policies',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Helpdesk',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'ADP',
                    'url' => '/'
                ],
                (object) [
                    'title' => '401K',
                    'url' => '/'
                ],
                (object) [
                    'title' => '401K',
                    'url' => '/'
                ]
            ]
        ];

        $news = (object) [
            'name' => 'Company News',
            'posts' => [
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ]
            ]
        ];

        $itNews = (object) [
            'name' => 'I.T. News',
            'posts' => [
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ],
                (object) [
                    'title' => 'Lorem ipsum dolor sit amet consect',
                    'url' => '/'
                ]
            ]
        ];
    @endphp

    <x-dashboard.horizontal-list :items="$resources->posts" :heading="$resources->name" size="small" />
    <x-dashboard.horizontal-list :items="$news->posts" :heading="$news->name" />
    <x-dashboard.horizontal-list :items="$itNews->posts" :heading="$itNews->name" />
</x-app-layout>
