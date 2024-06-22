<div >
    <div class="flex items-center mb-4 justify-center">
        <a
            href="{{route('season.show', ['id' => $team->season->id])}}"
            class="mr-auto flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700"
        >
            <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
            </svg>
            <span>Ver temporada</span>
        </a>
        @if($editMode)
            <div class="min-w-fit flex gap-2 items-center">
                <label for="nameInput"
                       class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <x-input type="search"
                         wire:model.live="name"
                         @search="$dispatch('closeEditMode')"
                         id="nameInput"
                         placeholder="{{$team->name}}"
                         required
                />
                <button wire:click="updateName"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <x-fas-check class="w-4 h-4"/>
                </button>
            </div>
        @else
            <h1 wire:click="editName"
                class="text-2xl min-w-fit font-bold cursor-pointer text-center">
                <x-far-pen-to-square
                    class="inline w-4 h-4 text-gray-500 dark:text-gray-400"/>
                {{$team->name}}
            </h1>
        @endif
    </div>

    <div class="flex items-center max-w-4xl gap-2 mx-auto mb-5">
        <label for="voice-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   id="search"
                   placeholder="Buscar jugador..."
                   wire:model.live="search"
                   required/>
        </div>
        @livewire('player.create', ['team_id' => $team->id])
    </div>

    <div class="max-w-full mx-auto p-4 flex flex-wrap justify-center">
        @if(count($this->players) > 0)
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                @foreach($this->players as $player)
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 min-h-96 max-h-64 flex flex-col">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col h-full">
                            <div class="relative w-full h-48">
                                <img class="absolute inset-0 w-full h-full object-cover" src="{{$player->photo_url}}"
                                     alt="Foto de la liga"/>
                            </div>
                            <div class="p-4 flex flex-col justify-between flex-grow">
                                <h3 class="text-2xl font-semibold mb-2">{{$player->name}}</h3>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    # {{$player->jersey_number}}</p>
                                <div class="flex items-center justify-between mt-auto">
                                    <a href="{{route('player.show', ['id' => $player->id])}}"
                                       class="min-w-fit inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Ver credencial
                                    </a>
                                    <button wire:click="confirmDelete({{$player->id}})"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        <x-fas-trash class="w-4 h-4 mr-1"/>
                                        <span>Eliminar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div x-intersect.full="$wire.loadMore()" class="p-4">
                <div wire:loading wire:target="loadMore"
                     class="loading-indicator">
                    Cargando más jugadores...
                </div>
            </div>
        @else
            <h2 class="py-4 text-center text-3xl dark:text-gray text-gray-500">
                No hay jugadores en este equipo
            </h2>
        @endif
    </div>

    @livewire('helpers.delete-modal', [
    'modalId' => 'deletePlayer',
    'action' => 'deletePlayer',
    'actionName' => 'Eliminar',
    'title' => 'Eliminar jugador',
    'content' => '¿Está seguro de que desea eliminar este jugador? <b>Esta acción es irreversible</b>',
    ])
</div>
