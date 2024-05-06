<div>
    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
        Hola {{ Auth::user()->name }} <br>
        Bienvenido al Sistema de Credenciales de Villa 7
    </h1>

    <div>
        <h2 class="text-xl font-medium mb-2 text-center">Mi código QR</h2>
        <div class="border shadow w-fit m-auto">
            <img id="qr-img" alt="{{Auth::user()->name}}"/>
        </div>
        <p id="qr-error"></p>
    </div>

    <a href="{{ route('qr-test') }}" class="bg-slate-300 rounded-lg p-4">Test QR
        camera</a>
</div>

<script type="module">
    const userEmail = {{Js::from(Auth::user()->email) }};
    let qrDiv = document.getElementById("qr-img");

    QRCode.toDataURL(userEmail, {version: 3, width: 300}).then((url) => {
        qrDiv.src = url;
    }).catch(err => {
        let p = document.getElementById("qr-error");
        p.textContent = "No se pudo generar tu código QR";
    });
</script>
