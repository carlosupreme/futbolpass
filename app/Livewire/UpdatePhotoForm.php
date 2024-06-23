<?php

namespace App\Livewire;

use App\Utils\Toast;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdatePhotoForm extends Component
{
    use WithFileUploads;

    public $showButton;

    public $photo;
    public $size;

    public $model;

    public $open;

    public function mount($model, $showButton = true, $size = '1024')
    {
        $this->open = false;
        $this->model = $model;
        $this->size = $size;
        $this->showButton = $showButton;
    }

    public function close()
    {
        $this->open = false;
        $this->photo = null;
    }

    public function updatePhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:' . $this->size,
        ]);

        $this->model->updatePhoto($this->photo);

        $this->dispatch('photoUpdated');
        Toast::success($this, 'Foto actualizada');
        $this->close();
    }

    public function render()
    {
        return view('livewire.update-photo-form');
    }
}
