<div>
    <h1 class="text-3xl font-medium text-gray-900 dark:text-white mb-5">
        Información de jugador <br>
    </h1>

    <hr class="w-full h-1 mx-auto bg-gray-100 my-1 border-0 rounded md:my-2 dark:bg-gray-700">
    
    <h2 class="text-2xl font-medium text-center mb-3">Datos personales</h2>
    
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 m-auto">
        
        <dl class="max-w-md text-gray-900 divide-y divide-gray-200">
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Nombre completo</dt>
            <dd class="text-lg font-semibold">{{ $player->name }}</dd>
        </div>
        
        @if($player->photo)
        <div class="flex flex-col pb-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Foto de perfil</dt>
            <dd class="text-lg font-semibold"><img src="{{ $player->photo }} " class="w-full rounded-md" /></dd>
        </div>
        @endif

        <div class="flex flex-col py-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Nombre de equipo</dt>
            <dd class="text-lg font-semibold">
                {{ $player->team->name }}
            </dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-blue-500 md:text-lg dark:text-blue-400">Código QR</dt>
            <dd class="text-lg font-semibold">
                <div class="border shadow w-fit m-auto">
                    <img id="qr-img" alt="Código QR del jugador con ID = {{$player->id}}"/>
                </div>
            </dd>
        </div>
        </dl>

        <div>
            <p id="qr-error"></p>
        </div>
    </div>
</div>

<script type="module">
    const userID = {{Js::from($player->id) }};
    let qrDiv = document.getElementById("qr-img");

    QRCode.toDataURL(userID+"", {version: 3, width: 300}).then((url) => {
        qrDiv.src = url;
    }).catch(err => {
        let p = document.getElementById("qr-error");
        p.textContent = "No se pudo generar tu código QR";
    });
</script>
