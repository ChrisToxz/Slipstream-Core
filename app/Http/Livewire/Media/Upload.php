<?php

namespace App\Http\Livewire\Media;

use App\Helpers;
use App\Models\Tag;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Upload extends ModalComponent
{

    use WithFileUploads;

    public $media; //file
    public $title, $description; //fields

    public function updatedMedia()
    {
        //TODO: If video -> Create thumb for preview
        $this->validate([
            'media' => 'required|file|mimetypes:video/mp4,video/mpeg,image/jpeg,image/png,image/bmp',
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

    }

    public function upload()
    {
        $title  = $this->title ?? $this->media->getClientOriginalName();
        $hash   = $this->media->hashName();

        $tag = Tag::create([
            'title' => $title,
            'description' => $this->description,
        ]);
    }

    public function render()
    {
        return view('livewire.media.upload');
    }
}
