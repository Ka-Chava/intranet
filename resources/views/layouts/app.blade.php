<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <livewire:styles />
    </head>
    <body class="font-sans antialiased w-full">
        <x-header.header />

        <div class="min-h-screen section pt-5 !px-5" id="WrapperContent">
            <x-aside.side-nav>
                <x-slot:header>
                    <x-aside.user-info />
                </x-slot:header>

                <x-aside.navigation class="mt-6" />
            </x-aside.side-nav>

            <!-- Page Content -->
            <main class="w-full container flex flex-col gap-6 max-w-full mx-auto px-0 min-w-0" id="MainContent">
                {{ $slot }}
            </main>

            @if(Route::current()->getName() === 'handbook')
                <livewire:handbook-drawer />
            @endif

            <x-aside.side-nav position="right">
                <x-slot:header>
                    @php
                        $options = [['label' => 'All', 'value' => 'all']];
                    @endphp
                    <x-select
                        :options="$options"
                        selected="all"
                        id="calendar-select"
                        name="calendar"
                    />
                </x-slot:header>

                <livewire:calendar class="mt-1" />
                <livewire:holiday-list class="mt-10" />
            </x-aside.side-nav>
        </div>

        <livewire:scripts />
    </body>
</html>
