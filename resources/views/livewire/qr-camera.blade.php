<div class="p-5 bg-white h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-3xl leading-tight py-5">
            Lista de asistencias
        </h2>
        <!-- Modal toggle -->
        @if($partidoId)
            <button
                id="open-btn"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button"
            >
                Iniciar camara
            </button>
        @endif @if(count($games) > 0)
            <div class="flex items-center max-w-4xl gap-2 mx-auto my-5">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
                    >
                        <svg
                            class="w-4 h-4 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                    </div>
                    <input
                        type="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        id="search"
                        placeholder="Buscar partido..."
                        wire:model.live="search"
                        required
                    />
                </div>
            </div>
        @endif

        <div class="max-w-full mx-auto p-4 flex flex-wrap justify-center mb-4">
            @if(count($games) > 0)
                @livewire('game.show')
                <div
                    class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4"
                >
                    @foreach($games as $game)
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 min-h-96 flex flex-col"
                        >
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col h-full"
                            >
                                <div
                                    class="p-4 flex flex-col justify-between flex-grow"
                                >
                                    <h5
                                        wire:click="setGame('{{$game->id}}')"
                                        class="cursor-pointer text-center hover:underline hover:text-blue-700 mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                    >
                                        {{$game->name}}
                                    </h5>

                                    <h4 wire:click="watchList('{{$game->id}}')"
                                        class="hover:underline cursor-pointer text-center mb-5 font-normal text-gray-700 dark:text-gray-400"
                                    >Ver lista</h4>

                                    <h4
                                        class="text-center mb-5 font-normal text-gray-700 dark:text-gray-400"
                                    >
                                        {{\Carbon\Carbon::parse($game->date)->format('d/m/Y')}}
                                    </h4>
                                    <div
                                        class="grid grid-cols-3 grid-rows-3 place-items-center"
                                    >
                                        <img
                                            src="{{$game->homeTeam->logo_url}}"
                                            alt="Equipo local"
                                            class="rounded-full object-cover aspect-square"
                                        />

                                        <div class="row-span-3 text-4xl">vs</div>

                                        <img
                                            src="{{$game->awayTeam->logo_url}}"
                                            alt="Equipo visitante"
                                            class="rounded-full object-cover aspect-square"
                                        />

                                        <div class="text-2xl">
                                            {{$game->home_team_goals}}
                                        </div>
                                        <div class="text-2xl col-start-3">
                                            {{$game->away_team_goals}}
                                        </div>
                                        <h5 class="text-xl text-center row-start-3">
                                            {{$game->homeTeam->name}}
                                        </h5>
                                        <h5
                                            class="text-xl text-center col-start-3 row-start-3"
                                        >
                                            {{$game->awayTeam->name}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h2 class="py-4 text-center text-3xl dark:text-gray text-gray-500">
                    Da click en el boton para iniciar la asistencia
                </h2>
            @endif
        </div>

        <!-- Main modal -->
        <div
            wire:ignore
            id="default-modal-qr"
            tabindex="-1"
            aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-0.2rem)] max-h-full"
        >
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div
                    class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
                    >
                        <h3
                            class="text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Camara de asistencias
                        </h3>
                        <button
                            id="close-btn"
                            wire:click="$set('partidoId', null)"
                            type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal-qr"
                        >
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-5 md:p-5 space-y-5">
                        <!-- Here camera -->
                        <video
                            id="qr-camera-video"
                            className="w-full h-fit"
                        ></video>
                    </div>
                    <!-- Modal footer -->
                    <!--
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal-qr" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-hide="default-modal-qr" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                    </div>
                     -->
                    <div
                        class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"
                    >
                        <p id="error-msj"></p>
                    </div>
                </div>
            </div>
        </div>

        <p id="decodedInfo" wire:ignore class="py-5"></p>
    </div>
</div>
@script
<script>
    document.addEventListener("livewire:initialized", () => {
        let video = document.getElementById("qr-camera-video");
        let openBtn = document.getElementById("open-btn");
        let closeBtn = document.getElementById("close-btn");
        let errorMsj = document.getElementById("error-msj");
        let decodedMsj = document.getElementById("decodedInfo");
        let qr = null;

        // set the modal menu element
        const targetEl = document.getElementById("default-modal-qr");

        console.log("script!");
        // options with default values
        const options = {
            placement: "bottom-right",
            backdrop: "static",
            backdropClasses:
                "bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40",
            closable: true,
            onHide: () => {
                qr?.stop();
            },
            onShow: () => {
                qr?.start().catch((err) => {
                    errorMsj.innerText =
                        "Your camera cannot be activated. Check for browser permission";
                });
            },
        };

        // instance options object
        const instanceOptions = {
            id: "default-modal-qr",
            override: true,
        };

        const modal = new Modal(targetEl, options, instanceOptions);

        // ---------------------------------------------------------------

        QrScanner.hasCamera()
            .then(() => {
                instanceQR();
            })
            .catch((err) => {
                errorMsj.innerText = "Your device does not have a camera!";
            });

        function instanceQR() {
            qr = new QrScanner(
                video,
                (result) => {
                    console.log("decoded qr code: ", result);
                    Livewire.dispatch("qr-decoded", {decoded: result.data});
                },
                {
                    highlightCodeOutline: true,
                    highlightScanRegion: true,
                    maxScansPerSecond: 5,
                }
            );
        }

        $wire.on("selected", () => {
            modal.show();
        });

        openBtn?.addEventListener("click", function () {
            console.log("#clicked");
            modal.show();
        });

        closeBtn?.addEventListener("click", function () {
            qr?.stop();
            console.log("closed");
        });
    });
</script>
@endscript
