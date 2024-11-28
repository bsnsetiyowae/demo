@props([
    'href' => '',
    'type' => 'button',
    'target' => '_self',
    'rel' => '',
    'handle' => null,
    'to' => null,
])

@php
    $class =
        'inline-flex items-center no-underline px-4 py-2 bg-stone-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-stone-700 active:bg-stone-900 focus:outline-none focus:border-stone-900 focus:ring ring-stone-300 disabled:opacity-25 transition ease-in-out duration-150';
   
    $resolvedHref = $href;

    if ($handle === 'back' && !empty($to)) {
        $previousUrl = url()->previous();
        $previousSegment = last(explode('/', parse_url($previousUrl, PHP_URL_PATH)));
        $currentSegment = request()->segment(count(request()->segments()));
        $resolvedHref = $previousSegment === $currentSegment ? url($to) : $previousUrl;
    }
@endphp

@if ($resolvedHref !== '')
    <a href="{{ $resolvedHref }}" target="{{ $target }}" rel="{{ $rel }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
