@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block py-2 px-4 rounded bg-purple-100 text-purple-700 font-semibold'
        : 'block py-2 px-4 rounded text-gray-700 hover:bg-purple-50 hover:text-purple-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
