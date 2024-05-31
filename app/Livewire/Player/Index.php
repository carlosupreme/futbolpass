<?php

namespace App\Livewire\Player;

use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $search;

    #[On('playerCreated')]
    public function render()
    {
        $players = Player::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->get();

        return view('livewire.player.index', [
            'players' => $players
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('selectItem', $id);
    }

    #[On('deletePlayer')]
    public function deletePlayer($id)
    {
        $player = Player::find($id);
        if ($player->photo) {
            Storage::delete($player->photo);
        }
        $player->delete();

        $this->dispatch('actionCompleted');

        return redirect()->route('player.index')->with('flash.banner', 'Jugador eliminado correctamente');
    }

}
