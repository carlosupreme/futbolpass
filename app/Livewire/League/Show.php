<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Models\Season;
use App\Utils\Toast;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public League $league;
    public $search;
    public $seasons = [];

    public $editMode = false;
    public string $name = '';

    public function mount(League $league)
    {
        $this->league = $league;
        $this->name = $league->name;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    public function updateName()
    {
        if ($this->name === $this->league->name) {
            $this->closeEditMode();
            return;
        }

        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->league->update(['name' => $this->name]);
        $this->closeEditMode();
    }

    #[On('closeEditMode')]
    public function closeEditMode()
    {
        $this->name = $this->league->name;
        $this->editMode = false;
    }

    public function editName()
    {
        $this->editMode = true;
    }

    #[On('deleteSeason')]
    public function deleteSeason($id)
    {
        try {
            Season::destroy($id);
            $this->dispatch('actionCompleted');
            $this->dispatch('seasonDeleted');
            Toast::success($this, 'Temporada eliminada exitosamente');
        } catch (\Exception $e) {
            Toast::error($this, 'No se pudo eliminar la temporada');
            $this->dispatch('actionCompleted');
        }
    }

    #[On('seasonCreated')]
    #[On('seasonUpdated')]
    #[On('seasonDeleted')]
    public function render()
    {
        $this->seasons = $this->league->seasons()->withCount('teams', 'games')->get();
        return view('livewire.league.show');
    }
}
