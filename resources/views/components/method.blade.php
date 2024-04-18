@props(['method' => 'default'])

@php
    $default = 'font-mono text-xs font-semibold leading-6 rounded-lg px-1.5 ring-1 ring-inset';

    $classes = '';

    switch ($method) {
        case 'GET':
            $classes = $default . ' get';
            break;
        case 'POST':
            $classes = $default . ' post';
            break;
        case 'PUT':
            $classes = $default . ' put';
            break;
        case 'DELETE':
            $classes = $default . ' delete';
            break;
        case 'default':
            $classes = $default;
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $method }}</div>
