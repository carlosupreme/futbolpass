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
                <label for="jersey_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de jugador</label>
                <x-input wire:model="jersey_number" type="number" min="0" max="10" name="jersey_number" id="jersey_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="10" required/>
                <x-input-error for="jersey_number"/>
            </div>

            <div>
                <label for="league_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Liga 
                </label>
                <select wire:model.live="league_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach (\App\Models\League::all() as $league)
                        <option value="{{ $league->id }}">{{ $league->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="season_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Temporada 
                </label>
                <select wire:model.live="season_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:key.live="{{ $league_id }}">
                    @foreach (\App\Models\Season::whereLeagueId($league_id)->get() as $season)
                        <option value="{{ $season->id }}">{{ $season->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="team_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Equipo 
                </label>
                <select wire:model.live="team_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:key.live="{{ $season_id }}">
                    <option disabled>Selecciona un equipo</option>
                
                    @foreach (\App\Models\Team::whereSeasonId($season_id)->get() as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="team_id"/>
            </div>

            <div>
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la foto de perfil del jugador</label>
            </div>
            <div class="grid grid-cols-2 gap-2 w-full">
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
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG </p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" wire:model.live="photo"/>
                </label>
                @if($photo)
                    <img src="{{$photo->temporaryUrl()}}" alt="Foto del jugador" class="w-full h-64 object-contain rounded-lg"/>
                @endif
            </div>
            <x-input-error for="photo"/>

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
