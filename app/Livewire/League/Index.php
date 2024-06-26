<?php

namespace App\Livewire\League;

use App\Models\League;
use App\Utils\Toast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public int $on_page = 4;

    #[Computed]
    public function leagues(): Collection
    {
        return League::withCount('seasons')
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->take($this->on_page)
            ->get();
    }

    public function loadMore(): void
    {
        $this->on_page += 4;
    }

    #[On('leagueCreated')]
    #[On('leagueUpdated')]
    #[On('leagueDeleted')]
    public function render()
    {
        return view('livewire.league.index');
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deleteLeague')]
    public function deleteLeague($id)
    {
        try {
            $league = League::find($id);
            $photo = $league->logo;
            $league->delete();
            if ($photo) Storage::disk('public')->delete($photo);
            $this->dispatch('actionCompleted');
            $this->dispatch('leagueDeleted');
            Toast::success($this, 'Liga eliminada exitosamente');
        } catch (\Exception $e) {
            Toast::error($this, 'No se pudo eliminar la liga');
            $this->dispatch('actionCompleted');
        }
    }
}
