<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Administrator',
            'email'    => 'admin@example.com',
            'password' => 123,
            'role_id' => 1,
        ]);
    }
}
