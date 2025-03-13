@php
    $buttons = [
        'special' => [
            'title' => 'Special',
            'items' => [
                'large' => [
                    'label' => 'Special/Large',
                    'value' => 'button button--special button--large'
                ],
                'medium' => [
                    'label' => 'Special/Medium',
                    'value' => 'button button--special'
                ],
                'small' => [
                    'label' => 'Special/Small',
                    'value' => 'button button--special button--small'
                ],
            ],
        ],
        'primary' => [
            'title' => 'Primary',
            'items' => [
                'large' => [
                    'label' => 'Primary/Large',
                    'value' => 'button button--primary button--large'
                ],
                'medium' => [
                    'label' => 'Primary/Medium',
                    'value' => 'button button--primary'
                ],
                'small' => [
                    'label' => 'Primary/Small',
                    'value' => 'button button--primary button--small'
                ],
            ],
        ],
        'secondary' => [
            'title' => 'Secondary',
            'items' => [
                'large' => [
                    'label' => 'Secondary/Large',
                    'value' => 'button button--secondary button--large'
                ],
                'medium' => [
                    'label' => 'Secondary/Medium',
                    'value' => 'button button--secondary'
                ],
                'small' => [
                    'label' => 'Secondary/Small',
                    'value' => 'button button--secondary button--small'
                ],
            ],
        ],
        'tertiary' => [
            'title' => 'Tertiary',
            'items' => [
                'large' => [
                    'label' => 'Tertiary/Large',
                    'value' => 'button button--tertiary button--large'
                ],
                'medium' => [
                    'label' => 'Tertiary/Medium',
                    'value' => 'button button--tertiary'
                ],
                'small' => [
                    'label' => 'Tertiary/Small',
                    'value' => 'button button--tertiary button--small'
                ],
            ],
        ],
    ]
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Styleguide</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <livewire:styles />
    </head>
    <body class="font-sans antialiased bg-white w-full">
        <main class="w-full container max-w-full mx-auto" id="Styleguide">
            <h1 class="text-display-lg mb-10">
                Styleguide
            </h1>

            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>

            <div class="flex flex-wrap gap-20 my-10">
                @foreach ($buttons as $button)
                    <div class="flex flex-col gap-5">
                        {{ $button['title'] }}

                        @foreach($button['items'] as $item)
                            <div class="flex flex-col gap-5">
                                <span class="font-medium italic">
                                    {{ $item['label'] }}
                                </span>

                                <div class="flex gap-x-10">
                                    <button class="{{ $item['value'] }}">
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                        {{ $button['title'] }}
                                    </button>

                                    <button class="{{ $item['value'] }}">
                                        {{ $button['title'] }}
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                    </button>

                                    <button class="{{ $item['value'] }}">
                                        {{ $button['title'] }}
                                    </button>

                                    <button class="{{ $item['value'] }}">
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                    </button>
                                </div>

                                <div class="flex gap-x-10">
                                    <button class="{{ $item['value'] }}" disabled>
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                        {{ $button['title'] }}
                                    </button>

                                    <button class="{{ $item['value'] }}" disabled>
                                        {{ $button['title'] }}
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                    </button>

                                    <button class="{{ $item['value'] }}" disabled>
                                        {{ $button['title'] }}
                                    </button>

                                    <button class="{{ $item['value'] }}" disabled>
                                        <x:feather-figma class="{{str_contains($item['value'], 'button--small') ? 'w-5 h-5' : 'w-6 h-6'}}" />
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </main>
        <livewire:scripts />
    </body>
</html>
