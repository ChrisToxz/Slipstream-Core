<?php

namespace App\Http\Livewire\Dev;

use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public function render()
    {
        return view('livewire.dev.modal');
    }
}
