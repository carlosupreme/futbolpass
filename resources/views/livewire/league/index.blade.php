<div>
    <div class="flex gap-4 items-center max-w-3xl mx-auto mb-5">
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
                   placeholder="Buscar liga..."
                   wire:model.live="search"
                   required/>
        </div>
        @livewire('league.create')
    </div>

    <div class="max-w-full mx-auto p-4 flex flex-wrap justify-center">
        @if(count($this->leagues) > 0)
            <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                @foreach($this->leagues as $league)
                    <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 min-h-96 max-h-64 flex flex-col">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col h-full">
                            <div class="relative w-full h-48">
                                <img class="absolute inset-0 w-full h-full object-cover" src="{{$league->logo_url}}" alt="Foto de la liga"/>
                            </div>
                            <div class="p-4 flex flex-col justify-between flex-grow">
                                <h3 class="text-2xl font-semibold mb-2">{{$league->name}}</h3>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$league->seasons_count}} temporadas</p>
                                <div class="flex items-center justify-between mt-auto">
                                    <a href="{{route('league.show', ['id' => $league->id])}}"
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Ver más
                                    </a>
                                    <button wire:click="confirmDelete('{{$league->id}}')"
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
                    Cargando más ligas...
                </div>
            </div>
        @else
            <h2 class="py-4 text-center text-3xl dark:text-gray text-gray-500">
                No hay ligas registradas
            </h2>
        @endif
    </div>


    @livewire('helpers.delete-modal', [
    'modalId' => 'deleteLeague',
    'action' => 'deleteLeague',
    'actionName' => 'Eliminar',
    'title' => 'Eliminar Liga',
    'content' => '¿Está seguro de que desea eliminar esta Liga? <b>Esta acción es irreversible</b>',
    ])
</div>
