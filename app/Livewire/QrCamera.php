<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class QrCamera extends Component {
    public $title = "QR Camera";
    public $partidoId;

    #[Layout('layouts.app')]
    public function render() {
        return view('livewire.qr-camera');
    }

    #[On('qr-decoded')]
    public function addToList($decoded) {
        error_log("Adding player with email [" . $decoded .
        "] to attendance list of math with id = " . $this->partidoId);
    }
}
