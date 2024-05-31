<?php

namespace App\Livewire\Player;

use App\Models\Player;
use Livewire\Component;

class Show extends Component
{
    public Player $player;

    public function mount(Player $player)
    {
        $this->player = $player;
    }

    public function render()
    {
        return view('livewire.player.show');
    }
}
