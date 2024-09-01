<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name'     => 'Backlog',
            'board_id' => 1,
        ]);
        Group::create([
            'name'     => 'Análise',
            'board_id' => 1,
        ]);
        Group::create([
            'name'     => 'Desenvolvimento',
            'board_id' => 1,
        ]);
        Group::create([
            'name'     => 'Testes',
            'board_id' => 1,
        ]);

        Group::create([
            'name'     => 'Pronto',
            'board_id' => 1,
        ]);
    }
}
