<?php

namespace App\Livewire\Season;

use App\Models\Season;
use App\Utils\Toast;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    #[Validate('required|string|max:255|unique:leagues,name')]
    public $name;

    #[Validate('required|integer')]
    public $league_id;

    #[Validate('required|date')]
    public $start_date;

    #[Validate('required|date|after:start_date')]
    public $end_date;

    public function mount($league_id)
    {
        $this->league_id = $league_id;
    }

    public function store(): void
    {
        $this->validate();

        Season::create([
            'name' => $this->name,
            'league_id' => $this->league_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->dispatch('seasonCreated');
        $this->resetExcept('league_id');
        Toast::success($this, 'Nueva temporada registrada exitosamente');
    }

    public function resetValues()
    {
        $this->resetExcept('league_id');
    }

    public function render()
    {
        return view('livewire.season.create');
    }
}
