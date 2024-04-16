@props(['method' => 'default'])

@php
    $default = 'font-mono text-xs font-semibold leading-6 rounded-lg px-1.5 ring-1 ring-inset';

    $classes = match ($method) {
        'GET' => $default . ' get',
        'POST' => $default . ' post',
        'PUT' => $default . ' put',
        'DELETE' => $default . ' delete',
        'default' => $default,
    };
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $method }}</span>
