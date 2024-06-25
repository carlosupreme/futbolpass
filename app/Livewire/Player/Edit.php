<?php

namespace App\Livewire\Player;

use App\Models\Player;
use App\Utils\Toast;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    public Player $player;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|integer|max_digits:3')]
    public $jersey_number;

    #[Validate('required|exists:teams,id')]
    public $team_id;

    public $teams = [];

    public function mount($id)
    {
        $this->player = Player::findOrFail($id);
        $this->name = $this->player->name;
        $this->jersey_number = $this->player->jersey_number;
        $this->team_id = $this->player->team_id;

        $this->teams = $this->player->team->season->teams->pluck('name', 'id');
    }

    public function updatePlayer(): void
    {

        if ($this->name === $this->player->name &&
            $this->jersey_number === $this->player->jersey_number &&
            $this->team_id === $this->player->team_id) {
            Toast::info($this, 'No hay cambios que guardar');
            return;
        }

        $this->validate();

        $this->player->update([
            'name' => $this->name,
            'jersey_number' => $this->jersey_number,
            'team_id' => $this->team_id,
        ]);

        Toast::success($this, 'Jugador actualizado');
        $this->dispatch('playerUpdated');
    }

    public function selectTeam($id)
    {
        $this->team_id = $id;
    }

    #[On('photoUpdated')]
    #[On('playerUpdated')]
    public function render()
    {
        return view('livewire.player.edit');
    }
}
