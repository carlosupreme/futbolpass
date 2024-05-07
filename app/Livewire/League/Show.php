<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Models\Season;
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
        $season = Season::find($id);
        $season->delete();

        $this->dispatch('actionCompleted');
    }

    #[On('seasonCreated')]
    public function render()
    {
        $this->seasons = $this->league->seasons()->get();
        return view('livewire.league.show');
    }
}
