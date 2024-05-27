<?php

namespace App\Livewire\Team;

use App\Models\Team;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $open = false;

    #[Validate('required|string|max:255|unique:teams,name')]
    public $name;

    #[Validate('nullable|image')]
    public $logo;

    public $season_id;

    public function mount($season_id)
    {
        $this->season_id = $season_id;
    }

    public function store()
    {
        $this->validate();
        $team = Team::create([
            'season_id' => $this->season_id,
            'name' => $this->name,
        ]);

        if ($this->logo) $team->updatePhoto($this->logo);

        $this->dispatch('teamCreated');
        $this->reset();
    }

    public function resetValues()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.team.create');
    }
}
