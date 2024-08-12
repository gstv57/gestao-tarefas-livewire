<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Illuminate\View\View;
use Livewire\{Component};

class ProjetoIndex extends Component
{
    public function render(): View
    {
        return view('livewire.projeto.projeto-index', [
            'projetos' => Projeto::paginate(10),
        ])->layout('layouts.app');
    }
}
