<?php

namespace App\Livewire\Role;

use App\Models\{Permission, Role};
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Mockery\Exception;

class RoleIndex extends Component
{
    use LivewireAlert;

    public Collection $permissions;

    public Collection $roles;

    protected $listeners = ['role-deleted' => '$refresh', 'role-updated' => '$refresh'];

    public function render()
    {
        return view('livewire.role.role-index')->layout('layouts.app');
    }
    public function mount()
    {
        $this->authorize('view-role');
        $this->permissions = $this->getPermissionsProperty();
        $this->roles       = $this->getRolesProperty();
    }
    #[On('role-created')]
    public function refreshRoles()
    {
        $this->roles = $this->getRolesProperty();
    }
    public function getRolesProperty()
    {
        return Role::all();
    }
    public function getPermissionsProperty()
    {
        return Permission::all();
    }

    public function destroyRole(Role $role): void
    {
        try {
            $role->delete();
            $this->dispatch('role-deleted')->self();
            $this->alert('success', 'Role excluída com sucesso!');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
