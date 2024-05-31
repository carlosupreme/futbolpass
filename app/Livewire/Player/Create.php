<?php

namespace App\Livewire\Player;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public $open = false;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|integer|max:10')]
    public $jersey_number;

    #[Validate('required|integer')]
    public $team_id;

    #[Validate('required|image')]
    public $photo;
    
    public function render()
    {
        return view('livewire.player.create');
    }

    public function store()
    {
        $this->validate();

        

        $this->reset();
    }

    public function resetValues()
    {
        $this->reset();
    }
}
