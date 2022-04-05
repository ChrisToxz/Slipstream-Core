<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public function render()
    {
        return view('livewire.edit-user');
    }
}
