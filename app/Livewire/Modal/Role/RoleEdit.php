<?php

namespace App\Livewire\Modal\Role;

use App\Livewire\Role\RoleIndex;
use App\Livewire\Traits\IsModal;
use App\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleEdit extends Component
{
    use IsModal;

    use LivewireAlert;

    public $permissions;

    public $role;

    public $name;

    public $description;

    public $enabled_permissions;

    public $selected_permissions = [];

    public function mount($permissions)
    {
        $this->authorize('edit-role');
        $this->permissions = $permissions;
    }
    public function render()
    {
        return view('livewire.modal.role.role-edit');
    }
    #[On('show-modal')]
    public function show(Role $role)
    {
        $this->role = $role->load('permissions');
        $this->getPermissionsRole();
        $this->fill_form();
        $this->visibily = true;
    }
    public function fill_form()
    {
        $this->name        = $this->role->name;
        $this->description = $this->role->description;
    }
    public function getPermissionsRole()
    {
        $this->enabled_permissions  = $this->role->permissions->pluck('id')->toArray();
        $this->selected_permissions = $this->enabled_permissions;
    }

    public function save()
    {

        $this->authorize('edit-role');

        $this->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $this->role->update([
            'name'        => $this->name,
            'description' => $this->description,
        ]);

        $permissionsToAdd    = array_diff($this->selected_permissions, $this->enabled_permissions);
        $permissionsToRemove = array_diff($this->enabled_permissions, $this->selected_permissions);

        $this->role->permissions()->attach($permissionsToAdd);
        $this->role->permissions()->detach($permissionsToRemove);

        $this->enabled_permissions = $this->selected_permissions;

        $this->alert('success', 'Role atualizada com sucesso!');
        $this->dispatch('role-updated')->to(RoleIndex::class);
        $this->dispatch('close-modal');
    }

    #[On('hidden')]
    public function hidden()
    {
        $this->enabled_permissions = $this->selected_permissions;
    }
}
