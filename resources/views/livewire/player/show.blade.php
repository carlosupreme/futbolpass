<div class="w-full bg-white p-2 flex flex-col gap-9">
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
