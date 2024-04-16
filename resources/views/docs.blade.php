<x-docs-layout>
    <main @class([
        'flex-1 prose max-w-3xl',
        'max-w-none' => isset($frontmatter['toc']) && !$frontmatter['toc'] ?? false,
    ])>
        <article class="pb-12">
            @isset($frontmatter['title'])
                <h1>{{ preg_replace('/{brand}/', $brand, $frontmatter['title']) }}</h1>
            @endisset

            @isset($frontmatter['method'])
                <div class="mb-4 flex items-center bg-gray-600 gap-x-3">
                    <x-method method="{{ $frontmatter['method'] }}" />
                    <span class="font-mono text-xs text-zinc-400">{{ $frontmatter['label'] }}</span>
                </div>
            @endisset

            @isset($frontmatter['description'])
                <p>{{ preg_replace('/{brand}/', $brand, $frontmatter['description']) }}</p>
            @endisset
            {!! preg_replace('/{brand}/', $brand, $content) !!}
        </article>

    </main>

    @if ($frontmatter['toc'] ?? true)
        <x-table-of-content />
    @endif

</x-docs-layout>
