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
                <button title="Base URL" type="button" id="copy-base"
                    class="not-prose relative mb-4 inline-flex cursor-pointer items-center gap-x-3 rounded-md border border-transparent bg-stone-50 px-4 py-2 text-xs font-semibold text-white ring-1 ring-stone-900 hover:bg-stone-100 focus:outline-none active:bg-stone-50">
                    <x-method method="{{ $frontmatter['method'] }}" />
                    <code class="font-mono text-xs text-zinc-400">{{ $frontmatter['label'] }}</code>
                    <span aria-hidden="true"
                        class="rounded-lg bg-stone-900/50 py-1 pl-2 pr-3 text-xs text-stone-100">Copy</span>
                </button>
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
