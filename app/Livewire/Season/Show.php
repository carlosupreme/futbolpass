<?php

namespace App\Livewire\Season;

use App\Models\Game;
use App\Models\Season;
use App\Models\Team;
use App\Utils\Toast;
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

    public function showGame($gameId)
    {
        $this->dispatch('showGame', $gameId);
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
            Toast::success($this, 'Equipo eliminado exitosamente');
        } catch (\Exception $e) {
            debug($e);
            Toast::error($this, 'No se pudo eliminar el equipo');
        } finally {
            $this->dispatch('actionCompleted');
        }
    }

    // no sirve aun
    #[On('deleteGame')]
    public function deleteGame($id)
    {
        try {
            Game::destroy($id);
            $this->dispatch('teamDeleted', $id);
            Toast::success($this, 'Partido eliminado exitosamente');
        } catch (\Exception $e) {
            debug($e);
            Toast::error($this, 'No se pudo eliminar el partido');
        } finally {
            $this->dispatch('actionCompleted');
        }
    }

    #[On('teamCreated')]
    #[On('teamDeleted')]
    #[On('gameCreated')]
    #[On('gameDeleted')]
    public function render()
    {
        $teams = [];
        $games = [];
        if ($this->page === 'teams')
            $teams = Team::where('season_id', $this->season->id)
                ->where('name', 'like', "%$this->search%")
                ->latest()->get();
        else
            $games = Game::with('homeTeam', 'awayTeam')
                ->where('season_id', $this->season->id)
                ->where('name', 'like', "%$this->search%")
                ->latest()
                ->get();

        return view('livewire.season.show', compact('teams', 'games'));
    }
}
