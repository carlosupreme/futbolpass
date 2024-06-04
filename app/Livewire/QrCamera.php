<?php

namespace App\Livewire;

use App\Models\AttendanceList;
use App\Models\Game;
use App\Utils\Toast;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class QrCamera extends Component
{
    public $title = "QR Camera";
    public $partidoId;
    public $list = [];
    public $search;
    public $previus = null;

    public function render()
    {
        $games = [];
        if (!$this->partidoId)
            $games = Game::with('homeTeam', 'awayTeam')
                ->where('name', 'like', "%$this->search%")
                ->latest()
                ->get();

        return view('livewire.qr-camera', compact('games'));
    }

    public function setGame($id)
    {
        $this->partidoId = $id;
        
        $this->dispatch('selected');
    }
    

    #[On('qr-decoded')]
    public function addToList($decoded)
    {
        if($decoded === $this->previus) return;
        $this->previus = $decoded;
        $list = AttendanceList::where('game_id', $this->partidoId)
        ->where('is_present', false)
        ->pluck('player_id')
        ->toArray();

        if(!in_array($decoded, $list)) return;
        
        Toast::info($this, "Asistencia registrada");
        AttendanceList::where('game_id', $this->partidoId)
            ->where('player_id', $decoded)
            ->update(['is_present' => true]);
    }
}
