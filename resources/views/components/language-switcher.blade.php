<x-dropdown align="right" width="0">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-stone-500 transition duration-150 ease-in-out hover:text-stone-700 focus:outline-none">
            <div class="uppercase">{{ app()->currentLocale() }}</div>

            <div class="ms-1">
                <x-icons name="chevron-down" class="h-4 w-4" />
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                class="block w-full px-4 py-2 text-start text-sm leading-5 text-stone-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none">
                {{ $properties['name'] }}
            </a>
        @endforeach
    </x-slot>
</x-dropdown>
