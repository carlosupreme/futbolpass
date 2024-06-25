<?php

namespace App\Livewire\Team;

use App\Models\Team;
use App\Utils\Toast;
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

    #[Validate('nullable|image|max:5120')]
    public $logo;

    #[Validate('required|exists:seasons,id')]
    public $season_id;

    public function mount($season_id): void
    {
        $this->season_id = $season_id;
    }

    public function store(): void
    {
        $this->validate();
        $team = Team::create($this->except('open', 'logo'));

        if ($this->logo) $team->updatePhoto($this->logo);

        $this->dispatch('teamCreated');
        $this->resetValues();
        Toast::success($this, 'Nuevo equipo registrado exitosamente');
    }

    public function resetValues()
    {
        $this->resetExcept('season_id');
    }

    public function render()
    {
        return view('livewire.team.create');
    }
}
