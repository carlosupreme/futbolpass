<?php

namespace App\Livewire\League;

use App\Models\League;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $search;

    #[On('leagueCreated')]
    public function render()
    {
        $leagues = League::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->get();

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
        if ($league->logo) {
            Storage::delete($league->logo);
        }
        $league->delete();
        $this->dispatch('actionCompleted');

        return redirect()->route('league.index')->with('flash.banner', 'Liga eliminada correctamente');
    }
}
