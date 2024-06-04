<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    public $sidebarOpen = false;

    #[On('toggleSidebar')]
    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
