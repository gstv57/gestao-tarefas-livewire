<?php

namespace App\Livewire\Usuario;

use App\Models\{Role, User};
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsuarioShow extends Component
{
    use LivewireAlert;

    public User $usuario;

    public $name;

    public $email;

    public $role_id;

    public Collection $roles;

    public function render(): View
    {
        return view('livewire.usuario.usuario-show')->layout('layouts.app');
    }
    public function mount(User $id): void
    {
        $this->usuario = $id->load('role');
        $this->name    = $this->usuario->name;
        $this->email   = $this->usuario->email;
        $this->role_id = $this->usuario->role_id;
        $this->roles   = Role::all();
    }

    public function update(): void
    {
        $this->authorize('update-user');

        $this->validate([
            'name'    => ['required', 'min:3', 'string'],
            'role_id' => ['required', Rule::in(1, 2, 3)],
        ]);

        try {
            $this->usuario->name    = $this->name;
            $this->usuario->role_id = $this->role_id;
            $this->usuario->save();
            $this->alert('success', 'Usúario atualizado com sucesso!');
        } catch (Exception) {
            $this->alert('warning', 'Usúario não atualizado! Entre em contato com o suporte.');
        }
    }
}
