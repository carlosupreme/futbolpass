<div class="min-w-fit">
    <button type="button"
            wire:click="$set('open', true)"
            class="py-2.5 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Registrar Jugador
    </button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2><strong>Agregar Jugador</strong></h2>
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

                <div>
                    <label for="jersey_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Número de playera
                    </label>
                    <x-input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="jersey_number"
                        type="number"
                        min="0"
                        name="jersey_number"
                        id="jersey_number"
                        placeholder="10"
                        required
                    />
                    <x-input-error for="jersey_number"/>
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
