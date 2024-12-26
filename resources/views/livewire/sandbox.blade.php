<div class="px-2">
    <div class="flex space-x-2 mb-4">
        <input type="text" wire:model.lazy="merchantCode" placeholder="Merchant Code" class="w-full border rounded px-4 py-2" />

        <x-button wire:click="sendRequest">
            Try
        </x-button>
    </div>
    <div class="mb-4">
        <input type="text" wire:model.lazy="key" placeholder="Key" class="w-full border rounded px-4 py-2" />
    </div>

    <div wire:loading class="flex items-center space-x-2 mb-4 text-blue-500">
        <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <span>Processing request...</span>
    </div>

    @empty(! $status)
        <div class="mb-4">
            <span class="font-bold text-lg">Status</span>
            <div class="p-2 border rounded">{{ $status }}</div>
        </div>

        <figure title="Parameters Object" class="relative [&;_figcaption pre]:rounded-t-none">
            <figcaption class="bg-stone-900/95 rounded-t-lg text-stone-50 py-3.5 px-3" title="">
                Response
            </figcaption>
            <pre class="px-2.5">
                <x-torchlight-code language='json' contents='{!! $response !!}' />
            </pre>
            <button type="button" id="copy-button" class="absolute right-4 top-3 overflow-hidden rounded-lg bg-stone-900/50 py-1 pl-2 pr-3 text-xs">
                <span aria-hidden="true" class="text-stone-100">Copy</span>
            </button>
        </figure>
        <script>
            document.querySelectorAll("#copy-button").forEach(button => {
                button.addEventListener("click", async function () {
                    await copyCode(button.closest("figure").querySelector("pre code"), button.querySelector('span'))
                });
            });

            async function copyCode(code, button) {
                let text = code.innerText;

                await navigator.clipboard.writeText(text);

                button.innerText = "Copied!";

                setTimeout(() => {
                    button.innerText = "Copy";
                }, 700);
            }

        </script>
    @endempty
</div>

