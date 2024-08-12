<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use Illuminate\View\View;
use Livewire\{Component, WithPagination, WithoutUrlPagination};

class UsuarioIndex extends Component
{
    use WithoutUrlPagination;
    use WithPagination;
    public function render(): View
    {
        $usuarios = User::paginate(10);

        return view('livewire.usuario.usuario-index', [
            'usuarios' => $usuarios,
        ])->layout('layouts.app');
    }
}
