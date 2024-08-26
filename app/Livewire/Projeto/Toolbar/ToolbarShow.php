<?php

namespace App\Livewire\Projeto\Toolbar;

use App\Models\Projeto;
use Illuminate\View\View;
use Livewire\Component;

class ToolbarShow extends Component
{
    public Projeto $projeto;
    public function render(): View
    {
        return view('livewire.projeto.toolbar.toolbar-show');
    }
    public function mount(Projeto $id): void
    {
        $this->projeto = $id;
    }
}
