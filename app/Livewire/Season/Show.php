<?php

namespace App\Livewire\Season;

use App\Models\Game;
use App\Models\Season;
use App\Models\Team;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Season $season;
    public $leagues = [];
    public $search;

    public $page = 'teams';

    public function mount(Season $season)
    {
        $this->season = $season;
    }

    public function confirmTeamDelete($teamId)
    {
        $this->dispatch('selectItem', $teamId);
    }

    #[On('deleteTeam')]
    public function deleteTeam($teamId)
    {
        try {
            Team::destroy($teamId);
            $this->dispatch('teamDeleted', $teamId);
        } catch (\Exception $e) {
            debug($e);
            $this->dispatch('deleteTeamError');
            $this->dispatch('actionCompleted');
        }
    }

    #[On('teamCreated')]
    #[On('teamDeleted')]
    public function render()
    {
        $teams = [];
        $games = [];
        if ($this->page === 'teams')
            $teams = Team::where('season_id', $this->season->id)->latest()->get();
        else
            $games = Game::with('homeTeam', 'awayTeam')
                ->where('season_id', $this->season->id)
                ->latest()
                ->get();

        return view('livewire.season.show', compact('teams', 'games'));
    }
}
