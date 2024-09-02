<?php

namespace App\Livewire\Role;

use Livewire\Attributes\On;
use App\Models\{Permission, Role};
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class RoleIndex extends Component
{
    public Collection $permissions;

    public Collection $roles;

    public function render()
    {
        return view('livewire.role.role-index')->layout('layouts.app');
    }
    public function mount()
    {
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

}
