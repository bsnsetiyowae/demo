<x-docs-layout title="{{ isset($frontmatter['title']) ? $frontmatter['title'] : null }}">
    @php($toc = isset($frontmatter['toc']) ? $frontmatter['toc'] : true)

    <main @class(['flex-1 prose w-full', 'max-w-none' => !$toc, 'max-w-4xl' => $toc])>
        <article class="pb-12">
            @isset($frontmatter['title'])
                <h1>{{ $frontmatter['title'] }}</h1>
            @endisset

            @isset($frontmatter['method'])
                <button title="Base URL" type="button" id="copy-base" value="{{ $frontmatter['label'] }}"
                    class="not-prose relative mb-4 inline-flex cursor-pointer items-center gap-x-3 rounded-md border border-transparent bg-stone-50 px-4 py-2 text-xs font-semibold text-white ring-1 ring-stone-900 hover:bg-stone-100 focus:outline-none active:bg-stone-50">
                    <x-method method="{{ $frontmatter['method'] }}" />
                    <code class="font-mono text-xs text-zinc-400">{{ $frontmatter['label'] }}</code>
                    <span aria-hidden="true"
                        class="rounded-lg bg-stone-900/50 py-1 pl-2 pr-3 text-xs text-stone-100">Copy</span>
                </button>
            @endisset

            @isset($frontmatter['description'])
                <p class="max-w-xl">{{ $frontmatter['description'] }}</p>
            @endisset
            {!! $content !!}
        </article>

    </main>

    @if ($toc)
        <x-table-of-content />
    @endif

</x-docs-layout>
