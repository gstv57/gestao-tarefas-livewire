<?php

namespace App\Livewire\Traits;

use Livewire\Attributes\On;

trait IsModal
{
    public bool $visibily = false;
    #[On('show-modal')]
    public function show()
    {
        $this->visibily = true;
    }
    #[On('close-modal')]
    public function hide()
    {
        $this->visibily = false;
        $this->dispatch('hidden')->self();
    }
}
