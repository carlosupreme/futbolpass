<?php

namespace App\Livewire\Player;

use App\Models\Player;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function render()
    {
        $players = Player::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->get();

        return view('livewire.player.index', [
            'players' => $players
        ]);
    }
}
