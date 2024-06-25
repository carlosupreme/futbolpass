<?php

namespace App\Livewire\Game;

use App\Models\AttendanceList;
use App\Models\Game;
use App\Models\Team;
use App\Utils\Toast;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|date')]
    public $date;

    #[Validate('required|different:awayTeamId')]
    public $home_team_id = "";

    #[Validate('required|different:homeTeamId')]
    public $away_team_id = "";

    #[Validate('required|exists:seasons,id')]
    public $season_id;

    public function mount($season_id)
    {
        $this->season_id = $season_id;
    }

    public function store()
    {
        $this->validate();

        $game = Game::create($this->except('open'));

        try {
            $this->createAttendanceLists($game->id);
        } catch (Exception $e) {
            $game->delete();
            Toast::error($this, $e->getMessage());
            return;
        }

        $this->dispatch('gameCreated');
        $this->resetValues();
        Toast::success($this, 'Nuevo partido registrado exitosamente');
    }

    /**
     * @throws Exception
     */
    public function createAttendanceLists($gameId)
    {
        $players = Team::with('players')
            ->where('id', $this->home_team_id)
            ->orWhere('id', $this->away_team_id)
            ->get()
            ->pluck('players')
            ->flatten();

        if (empty($players->toArray())) {
            throw new Exception('No se encontraron jugadores en los equipos seleccionados');
        }

        $players->each(function ($player) use ($gameId) {
            AttendanceList::create([
                'game_id' => $gameId,
                'player_id' => $player->id,
            ]);
        });
    }

    public function resetValues()
    {
        $this->resetExcept('season_id');
    }

    public function render()
    {
        $teams = Team::where('season_id', $this->season_id)->get();
        return view('livewire.game.create', compact('teams'));
    }
}
