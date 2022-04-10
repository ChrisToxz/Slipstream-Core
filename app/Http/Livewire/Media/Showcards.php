<?php

namespace App\Http\Livewire\Media;

use App\Models\Tag;
use Livewire\Component;

class Showcards extends Component
{

    protected $listeners = ['refreshTags' => '$refresh'];

    public function render()
    {
        $tags = Tag::latest()->get();
        return view('livewire.media.showcards')->with(["tags" => $tags]);
    }
}
