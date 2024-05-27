import './bootstrap';
import {Livewire, Alpine} from '../../../vendor/livewire/livewire/dist/livewire.esm.js';
import focus from '@alpinejs/focus';
import QRCode from "qrcode";
import "flowbite";
import QrScanner from "qr-scanner";
import {Modal} from "flowbite";

window.QRCode = QRCode;
window.QrScanner = QrScanner;
window.Modal = Modal;

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('showSidebar', {
        on: true,

        toggle() {
            this.on = !this.on
        }
    });
});

Alpine.plugin(focus);

Livewire.start()

