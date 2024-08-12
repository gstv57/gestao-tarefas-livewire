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
            'name'     => 'Doing',
            'board_id' => 1,
        ]);
        Group::create([
            'name'     => 'Review',
            'board_id' => 1,
        ]);
        Group::create([
            'name'     => 'Done',
            'board_id' => 1,
        ]);
    }
}
