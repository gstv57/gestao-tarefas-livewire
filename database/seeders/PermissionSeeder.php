<?php

namespace Database\Seeders;

use App\Models\{Permission, Role};
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $allRoles = Role::all()->keyBy('id');

        $permissions = [
            'create-user' => [Role::ROLE_ADMINISTRATOR],
            'update-user' => [Role::ROLE_ADMINISTRATOR],
        ];

        foreach ($permissions as $key => $roles) {
            $permission = Permission::create(['name' => $key]);

            foreach ($roles as $role) {
                $allRoles[$role]->permissions()->attach($permission->id);
            }
        }
    }
}
