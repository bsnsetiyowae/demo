@props([
    'href' => '',
    'type' => 'button',
])

@php
    $class =
        'inline-flex items-center no-underline px-4 py-2 bg-stone-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150';

@endphp

@if ($href !== '')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
