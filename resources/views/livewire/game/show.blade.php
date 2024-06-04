<x-dialog-modal wire:model="open">
    <x-slot name="title">
        <h2><strong>{{$game?->name}}</strong></h2>
    </x-slot>
    <x-slot name="content">
        <div class="overflow-x-auto my-5">
            <div class="py-2 mb-2 w-full text-sm grid grid-cols-4 border-b-4 font-bold text-gray-700">
                <h2 class="border-r-4 col-span-2">Jugador</h2>
                <h2 class="border-r-4 pl-4">Equipo</h2>
                <h2 class="pl-4">Asistencia</h2>
            </div>

            @foreach($players as $player)
                <div
                    wire:key="{{$player["player"]->id}}"
                    class="py-2 border-b w-full grid grid-cols-4 text-sm"
                >
                    <div class="flex items-center gap-2 col-span-2">
                        <img
                            src="{{$player["player"]->photo_url}}"
                            alt=""
                            class="w-8 h-8 object-cover rounded-full"
                        />
                        <a
                            href="{{route('player.show', ['id' => $player["player"]->id])}}"
                            class="font-bold text-primary-600 hover:underline dark:text-primary-500"
                        >
                            {{$player["player"]->name}} # {{$player["player"]->jersey_number}}
                        </a>
                    </div>

                    <div class="pl-2 flex items-center gap-2">
                        <img
                            alt=""
                            src="{{$player["team"]->logo_url}}"
                            class="w-8 h-8 object-cover rounded-full"
                        />
                        <p class="text-gray-600 font-bold">{{$player["team"]->name}}</p>
                    </div>

                    <div class="pl-2 flex items-center">
                        @if($player["present"])
                            <span
                                class="text-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                            Si
                          </span>
                        @else
                                    <span
                                        class="text-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                                    >
                            No
                          </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </x-slot>
    <x-slot name="footer"></x-slot>
</x-dialog-modal>
