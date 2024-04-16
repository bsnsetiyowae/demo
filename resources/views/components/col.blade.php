@props([
    'sticky' => false,
])

<div
    {{ $attributes->merge([
        'class' =>
            '[&>:first-child]:mt-0 [&>:last-child]:mb-0 ' .
            ($sticky ? 'md:sticky md:top-28 md:h-fit md:max-h-fit md:overflow-y-auto' : ''),
    ]) }}>
    {{ $slot }}
</div>
