<?php

namespace App\Livewire\Usuario;

use App\Models\{User};
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsuarioCreate extends Component
{
    use LivewireAlert;

    public $name;

    public $email;

    public $password;

    public $role_id;
    public function render(): View
    {
        return view('livewire.usuario.usuario-create', compact('roles'))
            ->layout('layouts.app');
    }
    public function save(): void
    {
        $validated = $this->validate([
            'name'     => ['required', 'min:3', 'string'],
            'email'    => ['required', 'min:3', 'email', 'unique:users,email'],
            'password' => ['required', 'min:3', Password::defaults()],
            'role_id'  => ['required', Rule::in(1, 2, 3)],
        ]);

        try {
            User::create($validated);
            $this->alert('success', 'Usúario criado com sucesso!');
            $this->unfill();
        } catch (Exception) {
            $this->alert('warning', 'Aconteceu algo inesperado! Tente novamente.');
        }
    }
    public function unfill(): void
    {
        $this->reset();
    }
}
