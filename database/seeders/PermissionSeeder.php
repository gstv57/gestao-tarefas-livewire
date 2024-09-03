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
            'navbar'     => ['user', 'projetos', 'roles'],
            'user'       => ['create', 'view', 'edit', 'update', 'destroy', 'list'],
            'role'       => ['create', 'view', 'edit', 'update', 'destroy'],
            'permission' => ['create', 'view', 'edit', 'update', 'destroy'],
            'projeto'    => ['create', 'view', 'edit', 'update', 'destroy', 'attach-user', 'list-user', 'settings', 'reorder-group', 'reorder-task'],
            'board'      => ['create', 'view', 'edit', 'update', 'destroy'],
            'group'      => ['create', 'view', 'edit', 'update', 'destroy'],
            'task'       => ['create', 'view', 'edit', 'update', 'destroy', 'upload-file', 'detail', 'attach-for-me'],
        ];

        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action) {
                // Criação da permissão
                $permission = Permission::create(['name' => "{$action}-{$module}"]);
                DB::table('permission_role')->insert([
                    'role_id'       => 1, // Altere conforme necessário
                    'permission_id' => $permission->id,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
        DB::table('role_users')->insert([
            'role_id'    => 1,
            'user_id'    => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
