<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <!-- Fonts -->
        @isset($head)
            {{ $head }}
        @endisset
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>

    <body class="bg-zinc-700 p-4 text-gray-50">
        <x-layout.header />
        <main class="mx-auto max-w-screen-lg rounded-2xl bg-zinc-900 px-5 py-6">
            {{ $slot }}
        </main>
    </body>

</html>
