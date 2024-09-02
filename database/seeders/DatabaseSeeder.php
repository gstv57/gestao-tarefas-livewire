<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ProjetoSeeder::class);
        $this->call(BoardSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
