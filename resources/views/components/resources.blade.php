@props([
    'resources' => __('messages.resources.sections'),
])

<div class="my-16 xl:max-w-none">
    <h2 id="resource">{{ __('messages.resources.title') }}</h2>
    <p class="text-sm">{{ __('messages.resources.description') }}</p>
    <div class="not-prose mt-2 grid grid-cols-1 gap-4 border-t border-stone-900/5 pt-6 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($resources as $resource)
            <a href={{ $resource['href'] }}
                class="group rounded-2xl bg-stone-800 px-4 pb-4 pt-8 transition-shadow hover:bg-stone-900 hover:shadow-md">
                <h3 id="{{ Str::slug($resource['name']) }}" class="mt-4 text-sm font-semibold leading-7 text-white">
                    {{ $resource['name'] }}
                </h3>
                <p class="mt-1 text-sm text-stone-400">{{ $resource['description'] }}</p>
            </a>
        @endforeach
    </div>
</div>
