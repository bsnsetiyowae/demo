@props([
    'guides' => __('messages.guides.sections'),
])

<div class="my-16 xl:max-w-none">
    <h2 id="guides">{{ __('messages.guides.title') }}</h2>
    <div class="not-prose mt-2 grid grid-cols-1 gap-8 border-t border-stone-900/5 pt-6 sm:grid-cols-3">
        @foreach ($guides as $guide)
            <div class="flex flex-col">
                <h3 id={{ $slug = Str::slug($guide['name']) }} class="text-sm font-semibold text-stone-900">
                    {{ $guide['name'] }}</h3>
                <p class="mt-1 text-sm text-stone-600">{{ $guide['description'] }}</p>
                <p class="mt-4 flex-1 content-end">
                    <a href="{{ $guide['href'] }}"
                        class="tracking-wides inline-flex items-center rounded-md border border-transparent bg-stone-200 px-4 py-2 text-xs font-semibold uppercase text-stone-800 transition duration-150 ease-in-out hover:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 focus:ring-offset-stone-800 active:bg-stone-300">Read
                        more</a>
                </p>
            </div>
        @endforeach
    </div>
</div>
