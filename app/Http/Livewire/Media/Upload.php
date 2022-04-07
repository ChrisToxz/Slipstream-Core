<?php

namespace App\Http\Livewire\Media;

use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Upload extends ModalComponent
{

    use WithFileUploads;

    public $media; //file
    public $title, $description; //fields

    public function updatedMedia()
    {
        $this->validate([
            'media' => 'required|file|mimetypes:video/mp4,video/mpeg,image/jpeg,image/png,image/bmp',
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
    }

    public function render()
    {
        return view('livewire.media.upload');
    }
}
