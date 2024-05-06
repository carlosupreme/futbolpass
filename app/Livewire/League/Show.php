<?php

namespace App\Livewire\League;

use App\Models\League;
use Livewire\Component;

class Show extends Component
{
    public League $league;
    public $search;
    public $seasons = [];

    public function mount(League $league)
    {
        $this->league = $league;
    }

    public function render()
    {
        return view('livewire.league.show');
    }
}
