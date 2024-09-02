<?php

namespace App\Livewire\Role;

use App\Livewire\Traits\IsModal;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleCreate extends Component
{
    use IsModal;
    use LivewireAlert;
    public $permissions;

    public $name = '';
    public $permissionsSelected = [];

    public function render()
    {
        return view('livewire.role.role-create');
    }

    public function mount($permissions)
    {
        $this->permissions = $permissions;
    }

    public function save()
    {
        $role = Role::create([
            'name' => $this->name,
        ]);
        $role->permissions()->attach($this->permissionsSelected);
        $this->reset('name', 'permissionsSelected');
        $this->dispatch('close-modal')->self();
        $this->dispatch('role-created')->to(RoleIndex::class);
        $this->alert('success', 'Role criada com sucesso!');
    }
    #[On('hidden')]
    public function cleanup()
    {
        $this->name                = '';
        $this->permissionsSelected = 0;
    }
}
