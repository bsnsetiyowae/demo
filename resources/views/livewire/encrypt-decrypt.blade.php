 <x-row x-data="ParamsEditor">
     <x-col class="max-w-xl w-full mx-auto mt-8 p-6 bg-white rounded-lg">
         <div class="flex items-center justify-between mb-2 gap-x-2">
             <div>
                 <button type="button" class="px-4 py-2 text-sm border-b-2 border-stone-500" role="tab"
                     @click="mode = 'input'; parseBatchToInput()"
                     :class="{ 'border-b-2 border-stone-500': mode ==='input' }">
                     <div class="px-2 whitespace-nowrap rounded-md group-hover:bg-stone-700/60">
                         Key Value Edit</div>
                 </button>
                 <button type="button" class="px-4 py-2 text-sm " role="tab"
                     @click="mode = 'batch'; parseInputToBatch()"
                     :class="{ 'border-b-2 border-stone-500': mode ==='batch' }">
                     <div class="px-2 whitespace-nowrap rounded-md group-hover:bg-stone-700/60">
                         Batch Edit Mode</div>
                 </button>
             </div>
             <x-icons @click="handlePasteButton()" title="paste json" name="clipboard"
                 class="text-stone-900 cursor-pointer" />
         </div>
         <div x-cloak x-show="mode === 'input'" class="mb-4">
             <template x-for="(p, index) in params" :key="index">
                 <div class="flex items-center h-8 gap-2 mb-4">
                     <div class="grid grid-cols-2 gap-2 w-full">
                         <x-input type="text" x-model="p.key" placeholder="Key" class="h-9 placeholder:text-sm" />
                         <x-input type="text" x-model="p.value" placeholder="Value"
                             class="h-9 placeholder:text-sm" />
                     </div>
                     <x-icons name="trash" class="text-rose-500 cursor-pointer w-6 h-6 p-1"
                         @click="params.splice(index, 1)" />
                 </div>
             </template>
             <x-button @click="params.push(param)" class="mb-4 text-sm">Add New</x-button>
         </div>
         <div x-cloak x-show="mode === 'batch'" class="mt-4">
             <textarea x-model="batchEdit" @input="parseBatchToInput()"
                 placeholder="Enter key-value pairs separated by newline, keys and values separated by ':'"
                 class="h-[calc(100vh-12rem)] w-full rounded-md border px-2 py-1"></textarea>

         </div>
     </x-col>

     <x-col class="max-w-xl w-full mx-auto mt-8 p-6 bg-white rounded-lg">
         <div class="flex items-center justify-between mb-2 gap-x-2">
             <div>
                 <button type="button" class="px-4 py-2 text-sm border-b-2 border-stone-500" role="tab"
                     @click="version = 2; parseBatchToInput()"
                     :class="{ 'border-b-2 border-stone-500': version === 2 }">
                     <div class="px-2 whitespace-nowrap rounded-md group-hover:bg-stone-700/60">
                         Version 2</div>
                 </button>
                 <button type="button" class="px-4 py-2 text-sm " role="tab"
                     @click="version = 3; parseInputToBatch()"
                     :class="{ 'border-b-2 border-stone-500': version === 3 }">
                     <div class="px-2 whitespace-nowrap rounded-md group-hover:bg-stone-700/60">
                         Version 3</div>
                 </button>
             </div>

         </div>
         <div x-cloak x-show="version === 2" class="mb-4">
             <textarea @input="parseBatchToInput()" placeholder="" class="h-[calc(100vh-12rem)] w-full rounded-md border px-2 py-1">{{ $v2 }}</textarea>
         </div>
         <div x-cloak x-show="version === 3" class="mb-4">
             <textarea @input="parseBatchToInput()" placeholder="" class="h-[calc(100vh-12rem)] w-full rounded-md border px-2 py-1">{{ $v3 }}</textarea>

         </div>

         <x-button @click="sendEncrypt">
             Encrypt
         </x-button>
     </x-col>
 </x-row>
