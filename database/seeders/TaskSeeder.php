<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'name'     => 'Fazer 1',
            'group_id' => 1,
        ]);
        Task::create([
            'name'     => 'Fazer 2',
            'group_id' => 2,
        ]);
        Task::create([
            'name'     => 'Fazer 3',
            'group_id' => 3,
        ]);
        Task::create([
            'name'     => 'Fazer 4',
            'group_id' => 4,
        ]);
    }
}
