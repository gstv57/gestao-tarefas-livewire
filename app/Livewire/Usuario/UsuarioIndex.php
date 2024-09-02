<?php

namespace App\Livewire\Usuario;

use App\Models\{Role, User};
use Illuminate\View\View;
use Livewire\{Attributes\Validate, Component, WithPagination, WithoutUrlPagination};

class UsuarioIndex extends Component
{
    use WithoutUrlPagination;

    use WithPagination;

    #[Validate(['search' => ['nullable', 'string']])]
    public string $search = '';

    #[Validate(['role' => ['nullable', 'string']])]
    public string $role = '';

    public $roles = '';

    public function render(): View
    {
        $query = User::with('roles')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%');

        $usuarios = $query->paginate(10);

        return view('livewire.usuario.usuario-index', compact('usuarios'))
            ->layout('layouts.app');
    }

    public function mount()
    {
        $this->authorize('list-user');
        $this->roles = Role::all();
    }
}
