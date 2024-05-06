<div>
    <div class="flex items-center max-w-3xl mx-auto mb-5">
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
                   placeholder="Buscar temporada..."
                   wire:model.live="search"
                   required/>
        </div>
        @livewire('league.create')
    </div>

    @if(count($seasons) > 0)
        <div class="flex gap-4 flex-wrap">
            @foreach($seasons as $league)
                <div wire:key="{{$league->id}}"
                     class="max-w-sm min-w-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{route('league.show', ['id' => $league->id])}}">
                        <img class="rounded-t-lg w-96 h-96 object-cover"
                             src="{{$league->logo ?: Auth::user()->profile_photo_url}}" alt=""/>
                    </a>
                    <div class="p-5">
                        <a href="{{route('league.show', ['id' => $league->id])}}">
                            <h5 class="hover:underline mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$league->name}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Esta liga cuenta
                            con {{count($league->seasons)}} temporadas</p>

                        <div class="flex items-center justify-between ">
                            <a href="#"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver temporadas
                            </a>

                            <button wire:click="confirmDelete({{$league->id}})"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <x-fas-trash class="w-4 h-4 mr-1"/>
                                <span>Eliminar</span>
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center h-96">
            <p class="text-3xl text-gray-500">No hay temporadas en esta liga</p>
        </div>
    @endif


    @livewire('helpers.delete-modal', [
    'modalId' => 'deleteLeague',
    'action' => 'deleteLeague',
    'actionName' => 'Eliminar',
    'title' => 'Eliminar Liga',
    'content' => '¿Está seguro de que desea eliminar esta Liga? <b>Esta acción es irreversible</b>',
    ])
</div>
