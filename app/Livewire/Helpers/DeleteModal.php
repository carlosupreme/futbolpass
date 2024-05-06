<?php

namespace App\Livewire\Helpers;

use Livewire\Component;

class DeleteModal extends Component
{
    public $modalId;
    public $identifier;
    public $open;
    public $action;
    public $title;
    public $content;
    public $actionName;

    protected $listeners = ['selectItem', 'actionCompleted'];

    public function mount()
    {
        $this->open = false;
    }

    public function selectItem($identifier)
    {
        $this->identifier = $identifier;
        $this->open = true;
    }

    public function confirm()
    {
        $this->dispatch($this->action, $this->identifier);
    }

    public function actionCompleted()
    {
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.helpers.delete-modal');
    }
}
