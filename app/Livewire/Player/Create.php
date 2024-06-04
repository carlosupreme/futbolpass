<?php

namespace App\Livewire\Player;

use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component {
    use WithFileUploads;

    public $open = false;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|integer|max:10')]
    public $jersey_number;

    #[Validate('required|integer')]
    public $team_id;

    #[Validate('required|image')]
    public $photo;

    public $league_id;
    public $season_id;

    public function store()
    {
        $this->validate();

        Player::create([
            'name' => $this->name,
            'jersey_number' => $this->jersey_number,
            'team_id' => $this->team_id,
            'photo' => $this->photo ? Storage::url($this->photo->store('players')): null,
        ]);

        $this->dispatch('playerCreated');

        $this->reset();
    }

    public function resetValues()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.player.create');
    }
}
