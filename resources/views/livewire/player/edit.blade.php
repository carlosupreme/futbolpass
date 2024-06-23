<div class="w-full bg-white p-10 flex flex-col gap-9">
    <a
        href="{{route('team.show', ['id' => $player->team->id])}}"
        class="mr-auto flex items-center justify-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700"
    >
        <svg class="w-5 h-5 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"/>
        </svg>
        <span>Ver jugadores</span>
    </a>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-10">
            <img
                    class="w-32 h-32 object-cover rounded-full border-gray-100 border-2"
                    src="{{$player->photo_url}}"
                    alt="{{$player->name}}"
            >
            <div class="flex flex-col gap-6 font-bold">
                <h1 class="text-gray-800 text-2xl">{{$player->name}}</h1>
                <div class="text-gray-600 text-sm">
                <span
                        class="hover:underline bg-gray-100 text-gray-800 font-medium me-2 px-2.5 py-2 rounded dark:bg-gray-700 dark:text-gray-300">
                    Equipo: {{$player->team->name}}
                </span>
                    <span
                            class="ml-2 bg-gray-100 text-gray-800 font-medium me-2 px-2.5 py-2 rounded dark:bg-gray-700 dark:text-gray-300">
                    Numero de playera: #{{$player->jersey_number}}
                </span>
                </div>
            </div>
        </div>
        @livewire('update-photo-form', ['model' => $player])
    </div>

    <div class="grid grid-cols-2">
        <div class="flex flex-col items-center justify-center gap-4 col-span-1">
            <h1 class="font-bold text-3xl">Editar información</h1>
            <h4>Aqui puedes editar la informacion del jugador</h4>
        </div>

        <div class="flex flex-col gap-4 col-span-1">
            <div class="flex flex-col">
                <x-label for="name" value="Nombre"/>
                <x-input type="text" id="name" wire:model="name"/>
                <x-input-error for="name" class="mt-2"/>
            </div>

            <div class="flex flex-col">
                <x-label for="jersey_number" value="Numero de playera"/>
                <x-input type="text" id="jersey_number" wire:model="jersey_number"/>
                <x-input-error for="jersey_number" class="mt-2"/>
            </div>

            <div class="flex flex-col">
                <x-label for="team_id" value="Equipo"/>
                <div class="flex flex-wrap gap-y-2 mt-3">
                    @foreach($teams as $id => $team)
                        <span
                                wire:click="selectTeam({{$id}})"
                            @class([
    "bg-blue-100" => $team_id == $id,
    "bg-gray-100" => $team_id != $id,
    "cursor-pointer text-gray-800 w-fit text-sm font-medium me-2 px-2.5 py-2 rounded"
])>
                            {{$team}}
                        </span>
                    @endforeach
                </div>
                <x-input-error for="team_id" class="mt-2"/>
            </div>

            <x-button wire:click="update" class="mt-4 w-full justify-center py-3">Guardar</x-button>
        </div>
    </div>

</div>
