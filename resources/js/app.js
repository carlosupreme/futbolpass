import './bootstrap';
import "flowbite";
import "toastify-js/src/toastify.css";
import {Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm.js';
import focus from '@alpinejs/focus';
import QRCode from "qrcode";
import QrScanner from "qr-scanner";
import {Modal} from "flowbite";
import Toastify from 'toastify-js'

window.Toastify = Toastify;
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
window.addEventListener('toast', event => {
    switch (event.detail.type) {
        case 'info':
            showNotification('info', 'Information', event.detail.message);
            break;
        case 'success':
            showNotification('success', 'Success', event.detail.message);
            break;
        case 'warning':
            showNotification('warning', 'Warning', event.detail.message);
            break;
        case 'error':
            showNotification('error', 'Error', event.detail.message);
            break;
    }
});

function showNotification(type, title, message) {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        position: "right",
        style: {
            borderRadius: "1rem",
            fontSize: "1.3rem"
        }
    }).showToast();
}

Livewire.start()

