<?php

namespace App\Livewire\Season;

use App\Models\Season;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public Season $season;
    public $leagues=[];

    public function mount(Season $season)
    {
        $this->season = $season;
    }

    #[On('teamCreated')]
    public function render()
    {
        return view('livewire.season.show');
    }
}
