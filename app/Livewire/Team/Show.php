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
    public string $name = '';
    public $editMode = false;

    public function mount($teamId)
    {
        $this->team = Team::find($teamId);
        $this->name = $this->team->name;
    }

    public function updateName()
    {
        if ($this->name === $this->team->name) {
            $this->closeEditMode();
            return;
        }

        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->team->update(['name' => $this->name]);
        $this->closeEditMode();
    }

    #[On('closeEditMode')]
    public function closeEditMode()
    {
        $this->name = $this->team->name;
        $this->editMode = false;
    }

    public function editName()
    {
        $this->editMode = true;
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
        try {
            $player = Player::find($id);
            $player->delete();
            $player->deletePhoto();
            $this->dispatch('actionCompleted');
            $this->dispatch('playerDeleted');
            Toast::success($this, 'Jugador eliminado exitosamente');
        } catch (\Exception $e) {
            Toast::error($this, "El jugador se encuentra en una lista de asistencia y no puede ser eliminado");
            $this->dispatch('actionCompleted');
        }
    }

    #[On('playerCreated')]
    #[On('playerUpdated')]
    #[On('playerDeleted')]
    public function render()
    {
        return view('livewire.team.show');
    }
}
