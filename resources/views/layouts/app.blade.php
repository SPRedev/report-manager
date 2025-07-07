<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
@php
    $flashTypes = [
        'success' => ['bg' => 'green', 'icon' => '✅', 'label' => 'Success'],
        'error' => ['bg' => 'red', 'icon' => '❌', 'label' => 'Error'],
        'warning' => ['bg' => 'yellow', 'icon' => '⚠️', 'label' => 'Warning'],
        'info' => ['bg' => 'blue', 'icon' => 'ℹ️', 'label' => 'Info'],
    ];
@endphp

@foreach ($flashTypes as $type => $config)
    @if (session($type))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            class="fixed top-5 right-5 z-50 bg-{{ $config['bg'] }}-100 border-l-4 border-{{ $config['bg'] }}-500 text-{{ $config['bg'] }}-800 px-4 py-3 rounded shadow-lg mb-4 w-72"
            role="alert"
        >
            <div class="flex items-center">
                <span class="text-xl mr-2">{{ $config['icon'] }}</span>
                <div class="flex-1">
                    <strong class="font-bold">{{ $config['label'] }}:</strong>
                    <span class="block sm:inline">{{ session($type) }}</span>
                </div>
            </div>
        </div>
    @endif
@endforeach
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('global-search');
    if (!searchInput) return;

    const endpoint = searchInput.dataset.searchEndpoint;
    const targetSelector = searchInput.dataset.searchTarget;
    const resultContainer = document.querySelector(targetSelector);

    if (!endpoint || !resultContainer) return;

    let timeout = null;

    searchInput.addEventListener('input', function () {
        clearTimeout(timeout);
        const query = this.value;

        timeout = setTimeout(() => {
            fetch(`${endpoint}?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultContainer.innerHTML = '';

                    if (data.length === 0) {
                        resultContainer.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-gray-500">No results found.</td></tr>`;
                        return;
                    }

                    data.forEach(f => {
                        resultContainer.innerHTML += `
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4">${f.fourniseur_name}</td>
                                <td class="px-6 py-4">${f.phone ?? ''}</td>
                                <td class="px-6 py-4">${f.email ?? ''}</td>
                                <td class="px-6 py-4">${f.region ?? ''}</td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="/fourniseurs/${f.id}/edit" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 hover:bg-yellow-200 hover:text-yellow-900 text-sm font-semibold rounded-lg transition">✏️ Edit</a>
                                    <form action="/fourniseurs/${f.id}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-900 text-sm font-semibold rounded-lg transition">🗑️ Delete</button>
                                    </form>
                                </td>
                            </tr>`;
                    });
                });
        }, 300); // debounce delay
    });
});
</script>
