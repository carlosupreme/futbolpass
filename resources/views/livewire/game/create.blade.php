<div class="min-w-fit">
    <button type="button"
            wire:click="$set('open', true)"
            class="py-2.5 px-3 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Agregar partido
    </button>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <h2><strong>Agregar partido</strong></h2>
        </x-slot>
        <x-slot name="content">
            <div class="p-4">
                <div class="mb-5">
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >
                        Nombre del partido
                    </label>
                    <input
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Jornada 1"
                        required=""
                        wire:model="name"
                    />
                </div>

                <div class="mb-5">
                    <label
                        for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >
                        Cuando se juega
                    </label>
                    <input
                        type="date"
                        id="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="20"
                        required=""
                        wire:model="date"
                    />
                </div>

                <div class="mb-5">
                    <label
                        for="home_team_id"
                        class="block mb-5 text-sm font-medium text-gray-900 dark:text-white"
                    >
                        Equipos
                    </label>

                    <div class="grid grid-cols-3 place-items-center">

                        <div>
                            <select id="home_team_id" wire:model.live="home_team_id">
                                <option value="" disabled>Selecciona un equipo</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="home_team_id" class="mt-2"/>
                        </div>

                        <h2>VS</h2>

                        <div>
                            <select name="" id="away_team_id" wire:model.live="away_team_id">
                                <option value="" disabled>Selecciona otro equipo</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="away_team_id" class="mt-2"/>
                        </div>

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
