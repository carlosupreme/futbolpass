<?php

namespace App\Livewire\Team;

use App\Models\Player;
use App\Models\Team;
use App\Utils\Toast;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $search;
    public int $on_page = 4;
    public Team $team;

    public function mount($teamId)
    {
        $this->team = Team::find($teamId);
    }

    #[Computed]
    public function players(): Collection
    {
        return Player::where('team_id', $this->team->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->take($this->on_page)
            ->get();
    }

    public function loadMore(): void
    {
        $this->on_page += 4;
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deletePlayer')]
    public function deletePlayer($id)
    {
        $player = Player::find($id);
        if ($player->photo) $player->deletePhoto();
        $player->delete();
        $this->dispatch('actionCompleted');
        $this->dispatch('playerDeleted');
        Toast::success($this, 'Jugador eliminado exitosamente');
    }

    #[On('playerCreated')]
    #[On('playerUpdated')]
    #[On('playerDeleted')]
    public function render()
    {
        return view('livewire.team.show');
    }
}
