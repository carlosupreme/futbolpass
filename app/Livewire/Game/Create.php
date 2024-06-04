<?php

namespace App\Livewire\Game;

use App\Models\AttendanceList;
use App\Models\Game;
use App\Models\Team;
use App\Utils\Toast;
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
    public $homeTeamId = "";

    #[Validate('required|different:homeTeamId')]
    public $awayTeamId = "";

    public $season_id;

    #[Validate('nullable|string|max:255')]
    public $refereeName;

    public function mount($season_id)
    {
        $this->season_id = $season_id;
    }

    public function store()
    {
        $this->validate();

        $game = Game::create([
            'season_id' => $this->season_id,
            'name' => $this->name,
            'date' => $this->date,
            'home_team_id' => $this->homeTeamId,
            'away_team_id' => $this->awayTeamId,
            'referee_name' => $this->refereeName,
        ]);

        $this->createAttendanceLists($game->id);

        $this->dispatch('gameCreated');
        $this->resetValues();
        Toast::success($this, 'Nuevo partido registrado exitosamente');
    }

    public function createAttendanceLists($gameId)
    {
        Team::with('players')
            ->where('id', $this->homeTeamId)
            ->orWhere('id', $this->awayTeamId)
            ->get()
            ->pluck('players')
            ->flatten()
            ->each(function ($player) use ($gameId) {
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
