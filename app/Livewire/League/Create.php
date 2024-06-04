<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Utils\Toast;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $open = false;

    #[Validate('required|string|max:255|unique:leagues,name')]
    public $name;

    #[Validate('nullable|image')]
    public $logo;

    public function store()
    {
        $this->validate();
        $league = League::create(['name' => $this->name]);

        if ($this->logo) {
            $league->updatePhoto($this->logo);
        }

        $this->dispatch('leagueCreated');
        $this->reset();
        Toast::success($this, 'Nueva liga registrada exitosamente');
    }

    public function resetValues()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.league.create');
    }
}
