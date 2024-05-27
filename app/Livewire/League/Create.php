<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Utils\Toast;
use Illuminate\Support\Facades\Storage;
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
        League::create([
            'name' => $this->name,
            'logo' => $this->logo ? Storage::url($this->logo->store('leagues')): null,
        ]);

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
