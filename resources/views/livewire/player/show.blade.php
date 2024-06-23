<div class="w-full bg-white p-2 flex flex-col gap-9">
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
    <div class="flex items-center gap-2">
        <img
            class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-full border-gray-100 border-2"
            src="{{$player->photo_url}}"
            alt="{{$player->name}}"
        >
        <div class="flex flex-col gap-2 font-bold">
            <h1 class="text-gray-800 text-xl">{{$player->name}}</h1>
            <h2 class="text-gray-600">
                <a class="hover:underline"
                   href="{{route('team.show', ['id' => $player->team->id])}}">{{$player->team->name}}</a>
                <span class="ml-2">#{{$player->jersey_number}}</span>
            </h2>
        </div>
    </div>

    <div class="w-fit mx-auto">
        <img id="qr-img" alt="Código QR del jugador con ID = {{$player->id}}" src=""/>
    </div>

    <x-button
        x-data="{
            downloadQR() {
                const link = document.createElement('a');
                link.href = document.getElementById('qr-img').src;
                link.download = 'QR-' + '{{ $player->name }}' + '.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }"
        class="w-full lg:w-fit mx-auto justify-center"
        @click="downloadQR()"
    >
        Guardar QR
    </x-button>

    <script type="module">
        const userID = `{{ Js::from($player->id) }}`;
        const imageRef = document.getElementById("qr-img");
        const errorRef = document.getElementById("qr-error");
        const options = {version: 3, width: 400};

        QRCode.toDataURL(userID, options).then((url) => imageRef.src = url).catch(e => {
            errorRef.textContent = "No se pudo generar el código QR";
        });
    </script>
</div>
