<x-dropdown align="right" width="0">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-stone-500 transition duration-150 ease-in-out hover:text-stone-700 focus:outline-none">
            <div class="flex gap-x-2 items-center">
                <img src="{{ asset('flags/'. app()->currentLocale() .'.png') }}" class="w-5 h-auto" />
                <span class="hidden sm:block">{{ LaravelLocalization::getCurrentLocaleName() }}</span>
            </div>

            <div class="ms-1">
                <x-icons name="chevron-down" class="h-4 w-4" />
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                class="flex gap-x-2 items-center w-full px-4 py-2 text-start text-sm leading-5 text-stone-700 transition duration-150 ease-in-out hover:bg-stone-100 focus:bg-stone-100 focus:outline-none">
                <img src="{{ asset('flags/'. $localeCode .'.png') }}" class="w-5 h-auto"/>
                <span class="hidden sm:block">{{ $properties['name'] }}</span>
            </a>
        @endforeach
    </x-slot>
</x-dropdown>
