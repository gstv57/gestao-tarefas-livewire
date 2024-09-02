<?php

namespace Database\Seeders;

use App\Models\{Permission};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'user'       => ['create', 'view', 'edit', 'update', 'destroy'],
            'role'       => ['create', 'view', 'edit', 'update', 'destroy'],
            'permission' => ['create', 'view', 'edit', 'update', 'destroy'],
            'projeto'    => ['create', 'view', 'edit', 'update', 'destroy'],
            'board'      => ['create', 'view', 'edit', 'update', 'destroy'],
            'group'      => ['create', 'view', 'edit', 'update', 'destroy'],
            'task'       => ['create', 'view', 'edit', 'update', 'destroy'],
        ];

        // Loop para criar permissões e atribuí-las ao papel de admin
        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action) {
                // Criação da permissão
                $permission = Permission::create(['name' => "{$action}-{$module}"]);
                DB::table('permission_role')->insert([
                    'role_id'       => 1, // Altere conforme necessário
                    'permission_id' => $permission->id,
                ]);
            }
        }
    }
}
