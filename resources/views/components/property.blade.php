@props(['name', 'type' => null, 'required' => false])

<li class="!pl-0 pb-2 before:bg-transparent">
    <dl class="flex flex-wrap items-center gap-x-2 text-sm">
        <dt class="sr-only">Name</dt>
        <dd class="m-0 p-0">
            <code
                class="ml-1 inline-block rounded-full bg-cyan-200 px-2 py-1 text-xs font-semibold leading-none text-cyan-800">{{ $name }}</code>
        </dd>

        @if ($type)
            <dt class="sr-only">Type</dt>
            <dd class="m-0 p-0 font-mono text-xs text-zinc-400 dark:text-zinc-500">
                {{ $type }}
            </dd>
        @endif
        @if ($required)
            <span
                class="ml-1 inline-block rounded-full bg-red-200 px-2 py-1 text-xs font-semibold leading-none text-red-800">required</span>
        @endif
        <dt class="sr-only">Description</dt>
        <dd class="w-full flex-none [&>:first-child]:mt-0 [&>:last-child]:mb-0">
            {{ $slot }}
        </dd>
    </dl>
</li>
