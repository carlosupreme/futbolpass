<div class="min-w-fit">
    <button type="button"
            wire:click="$set('open', true)"
            class="py-2.5 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Agregar temporada
    </button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2><strong>Agregar temporada</strong></h2>
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

                <div class="flex gap-2 w-full">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2" for="name">
                            Fecha de inicio
                        </label>
                        <x-input class="w-full" wire:model="start_date" type="date" name="start_date" id="start_date"/>
                        <x-input-error for="start_date"/>
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-2" for="name">
                            Fecha de fin
                        </label>
                        <x-input class="w-full" wire:model="end_date" type="date" name="end_date" id="end_date"/>
                        <x-input-error for="end_date"/>
                    </div>

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
