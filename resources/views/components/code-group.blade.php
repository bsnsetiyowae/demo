<div code-group x-data="{
    tab: $el.querySelector('[data-title]').getAttribute('data-title') ?? $el.querySelector('[data-lang]').getAttribute('data-lang'),
    get languages() {
        return Array.from($el.querySelectorAll('[data-lang]')).map(el => el.getAttribute('data-lang'))
    }
}" class="[&_figure]:mt-0 [&_pre]:rounded-t-none">

    {{ $slot }}
</div>
