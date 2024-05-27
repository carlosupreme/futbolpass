<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Utils\Toast;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $search;

    #[On('leagueCreated')]
    #[On('leagueUpdated')]
    #[On('leagueDeleted')]
    public function render()
    {
        $leagues = League::withCount('seasons')
            ->where('name', 'like', '%' . $this->search . '%')->latest('id')->get();

        return view('livewire.league.index', [
            'leagues' => $leagues
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deleteLeague')]
    public function deleteLeague($id)
    {
        $league = League::find($id);
        if ($league->logo) $league->deletePhoto();
        $league->delete();
        $this->dispatch('actionCompleted');
        $this->dispatch('leagueDeleted');
        Toast::success($this, 'Liga eliminada exitosamente');
    }
}
