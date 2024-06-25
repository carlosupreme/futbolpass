<div class="min-w-fit">
    <button type="button"
            wire:click="$set('open', true)"
            class="py-2.5 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Agregar equipo
    </button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2><strong>Agregar equipo</strong></h2>
        </x-slot>
        <x-slot name="content">
            <div class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2" for="name">
                        Nombre
                    </label>
                    <x-input class="w-full" wire:model="name" type="text" name="name" id="name"/>
                    <x-input-error for="name"/>
                </div>

                <div class="grid grid-cols-2 gap-2 w-full place-content-center place-items-center">
                    <label for="dropzone-file"
                           class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click para subir</span>
                                o arrastra el archivo</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (Max 5 MB)</p>
                            <x-input-error for="logo"/>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" wire:model.live="logo"/>
                    </label>

                    <div wire:target="logo" wire:loading class="w-full flex flex-col gap-2 items-center justify-center">
                        <x-loader class="m-auto"/>
                        <p class="text-lg font-bold text-gray-400 w-full text-center">Subiendo archivo ...</p>
                    </div>

                    @if($logo)
                        <img src="{{$logo->temporaryUrl()}}" alt="Logo" class="w-full h-64 object-contain rounded-lg"/>
                    @endif
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="resetValues" class="mr-2">Cancelar</x-secondary-button>
            <button wire:click="store"
                    class="px-4 py-2.5 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
