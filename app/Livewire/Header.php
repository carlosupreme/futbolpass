<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{
    public function toggleSidebar()
    {
        $this->dispatch('toggleSidebar');
    }

    public function render()
    {
        return view('livewire.header');
    }
}
