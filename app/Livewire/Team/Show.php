<?php

namespace App\Livewire\Team;

use App\Models\Player;
use App\Models\Team;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Team $team;
    public $players = [];

    public function mount(Team $team)
    {
        $this->team = $team;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deletePlayer')]
    public function deletePlayer($id) {
        $player = Player::find($id);
        $player->delete();

        $this->dispatch('actionCompleted');
    }

    #[On("playerCreated")]
    public function render()
    {
        $this->players = $this->team->players()->get();
        return view('livewire.team.show');
    }
}
