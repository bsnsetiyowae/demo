<aside class="sticky top-24 mb-5 hidden min-w-[280px] max-w-[280px] px-4 prose-p:leading-loose lg:block lg:px-6 xl:px-8">
    <div x-show="headings.length" x-cloak>
        <p class="mb-2 mt-5 whitespace-nowrap text-xs font-semibold uppercase tracking-widest text-stone-700">
            {{ __('messages.on-page') }}
        </p>

        <div
            class="sticky text-sm text-stone-500 [&>*:hover]:text-stone-800 [&>*:hover]:transition-none [&>*]:block [&>*]:transition-colors [&>a]:py-2">
            <template x-for="(heading, index) in headings" :key="`heading-${index}`">
                <a :href="`#${heading.firstChild.id}`" x-text="heading.innerText"
                    :class="{
                        'text-stone-600 font-medium': activeHeading === heading,
                        'pl-4 border-l': heading.tagName === 'H3'
                    }"
                    class="transition" @click.prevent="scrollTo(heading.firstChild.id ?? heading.id)">

                </a>
            </template>
        </div>

    </div>
</aside>
