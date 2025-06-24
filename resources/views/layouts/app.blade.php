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
        
    </head>
    <body class="font-sans antialiased">
        <body class="font-sans antialiased bg-gray-100">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen">
            @include('layouts.partials.topbar')

            <main class="p-6 flex-1 bg-gray-100">
                @isset($header)
                    <div class="mb-4">{{ $header }}</div>
                @endisset
                {{ $slot }}
            </main>

            <footer class="bg-white p-4 text-center text-sm text-gray-400 border-t">
                © {{ date('Y') }} {{ config('app.name') }}
            </footer>
        </div>
    </div>
</body>

    </body>
</html>
