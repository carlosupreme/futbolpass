<?php

namespace App\Livewire\Game;

use App\Models\Game;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $open = false;

    public $players = [];
    public $game;

    #[On('showGame')]
    public function openModal($id)
    {
        $this->game = Game::with('homeTeam', 'awayTeam', 'attendanceLists')->find($id);
        $this->players = $this->game->attendanceLists->map(function ($list) {
            return [
                'player' => $list->player,
                'present' => $list->is_present,
                'team' => $list->player->team
            ];
        });
        $this->open = true;
    }

    public function render()
    {
        return view('livewire.game.show');
    }
}
