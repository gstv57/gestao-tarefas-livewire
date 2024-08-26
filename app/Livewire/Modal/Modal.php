<?php

namespace App\Livewire\Modal;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public $visible = false;

    #[On('show')]
    public function show()
    {
        $this->visible = true;
    }
    #[On('hide')]
    public function hide()
    {
        $this->visible = false;
    }
    public function render()
    {
        return view('livewire.modal.modal');
    }
}
