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
    <body class="font-sans antialiased bg-white w-full">
        <x-header.header />
        <div class="min-h-screen section pt-5" id="WrapperContent">
            <x-aside.side-nav />
            <!-- Page Content -->
            <main class="w-full container max-w-full mx-auto" id="MainContent">
                {{ $slot }}
            </main>
        </div>
        <livewire:scripts />
    </body>
</html>
