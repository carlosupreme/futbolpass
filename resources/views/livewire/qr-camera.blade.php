<div class="p-5 bg-white h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-3xl leading-tight py-5">
            Lista de asistencias
        </h2>
        <!-- Modal toggle -->
        <button id="open-btn" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Probar QR
        </button>

        <!-- Main modal -->
        <div wire:ignore id="default-modal-qr" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-0.2rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            QR Camera
                        </h3>
                        <button id="close-btn" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-qr">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-5 md:p-5 space-y-5">
                        <!-- Here camera -->
                        <video id="qr-camera-video" className="w-full h-fit">
                        </video>
                    </div>
                    <!-- Modal footer -->
                    <!--
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="default-modal-qr" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-hide="default-modal-qr" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                    </div>
                     -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
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
    document.addEventListener('livewire:initialized', () => {
        let video = document.getElementById("qr-camera-video");
        let openBtn = document.getElementById("open-btn");
        let closeBtn = document.getElementById("close-btn");
        let errorMsj = document.getElementById("error-msj");
        let decodedMsj = document.getElementById("decodedInfo");
        let qr = null;

        // set the modal menu element
        const targetEl = document.getElementById('default-modal-qr');

        console.log("script!");
        // options with default values
        const options = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses:
                'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                qr?.stop();
            },
            onShow: () => {
                qr?.start().catch((err) => {
                    errorMsj.innerText = "Your camera cannot be activated. Check for browser permission";
                });
            },
        };

        // instance options object
        const instanceOptions = {
            id: 'default-modal-qr',
            override: true
        };

        const modal = new Modal(targetEl, options, instanceOptions);

        // ---------------------------------------------------------------

        QrScanner.hasCamera().then(() => {
            instanceQR();
        }).catch(err => {
            errorMsj.innerText = "Your device does not have a camera!";
        });

        function instanceQR() {
            qr = new QrScanner(video,
            (result) => {
                console.log("decoded qr code: ", result);
                Livewire.dispatch('qr-decoded', {decoded: result.data});
                modal.hide();

                decodedMsj.innerHTML += "Decoded QR = " + result.data + "<br>";
            },
            {
                highlightCodeOutline: true,
                highlightScanRegion: true,
                maxScansPerSecond: 5,
            });
        }

        openBtn.addEventListener("click", function() {
            modal.show();
        });

        closeBtn.addEventListener("click", function() {
            qr?.stop();
        });

    });
</script>
@endscript
