<?php

namespace App\Livewire\Player;

use App\Models\Player;
use App\Utils\Toast;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component {
    use WithFileUploads;

    public $open = false;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|integer|max_digits:3')]
    public $jersey_number;

    #[Validate('required|integer|exists:teams,id')]
    public $team_id;

    #[Validate('nullable|image')]
    public $photo;

    public function mount($team_id)
    {
        $this->team_id = $team_id;
    }

    public function store()
    {
        $this->validate();

        $player = Player::create([
            'name' => $this->name,
            'jersey_number' => $this->jersey_number,
            'team_id' => $this->team_id,
        ]);

        if($this->photo) {
            $player->updatePhoto($this->photo);
        }

        $this->dispatch('playerCreated');

        $this->resetValues();
        Toast::success($this, 'Nuevo jugador registrado exitosamente');
    }
    
    public function resetValues()
    {
        $this->resetExcept('team_id');
    }

    public function render()
    {
        return view('livewire.player.create');
    }
}
