<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $faker = Factory::create();
            User::factory()->create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => 123,
            ]);
        }
    }
}
