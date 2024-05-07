<div>
    <h1 class="text-2xl min-w-fit font-bold text-center mb-4">
        {{$season->league->name}} - <span class="text-gray-700 text-xl">{{$season->name}}</span>
    </h1>

    <div class="flex items-center max-w-4xl gap-2 mx-auto mb-5">
        <h1 class="text-2xl min-w-fit font-bold text-center">Equipos</h1>
        <label for="search" class="sr-only">Search</label>
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
                   placeholder="Buscar equipo..."
                   wire:model.live="search"
                   required/>
        </div>
        @livewire('team.create', ['season_id' => $season->id])
    </div>

    @if(count($season->teams) > 0)
        <div class="flex gap-4  mb-5">
            @foreach($season->teams as $team)
                <div wire:key="{{$team->id}}"
                     class="w-64 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{route('league.show', ['id' => $team->id])}}">
                        <img class="rounded-t-lg w-full h-32 object-cover"
                             src="{{$team->logo ?: Auth::user()->profile_photo_url}}" alt=""/>
                    </a>
                    <div class="p-5">
                        <a href="{{route('league.show', ['id' => $team->id])}}">
                            <h5 class="hover:underline mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$team->name}}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Esta equipo cuenta
                            con {{count($team->players)}} jugadores</p>

                        <div class="flex items-center justify-between ">
                            <a href="{{route('league.show', ['id' => $team->id])}}"
                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Ver jugadores
                            </a>

                            <button wire:click="confirmDelete({{$team->id}})"
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
        <div class="flex items-center justify-center h-48">
            <p class="text-3xl text-gray-500">No hay equipos inscritos a esta temporada</p>
        </div>
    @endif

    <div class="flex items-center max-w-4xl gap-2 mx-auto mb-5">
        <h1 class="text-2xl min-w-fit font-bold text-center">Partidos</h1>
        <label for="search" class="sr-only">Search</label>
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
                   placeholder="Buscar partido..."
                   wire:model.live="search"
                   required/>
        </div>
        @livewire('league.create')
    </div>

    @livewire('helpers.delete-modal', [
    'modalId' => 'deleteLeague',
    'action' => 'deleteLeague',
    'actionName' => 'Eliminar',
    'title' => 'Eliminar Liga',
    'content' => '¿Está seguro de que desea eliminar esta Liga? <b>Esta acción es irreversible</b>',
    ])

</div>
