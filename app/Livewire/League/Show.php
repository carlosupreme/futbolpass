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

    public function mount(League $league)
    {
        $this->league = $league;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deleteSeason')]
    public function deleteSeason($id)
    {
        Season::destroy($id);

        $this->dispatch('actionCompleted');
        $this->dispatch('seasonDeleted');
        Toast::success($this, 'Temporada eliminada exitosamente');
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
