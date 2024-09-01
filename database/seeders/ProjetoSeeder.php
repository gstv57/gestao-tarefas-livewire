<?php

namespace Database\Seeders;

use App\Models\Projeto;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Projeto::create([
            'name'        => 'Desenvolvimento do Sistema do Marcelinho',
            'visibility'  => 'public',
            'description' => 'Desenvolvimento do Sistema do Marcelinho',
            'priority'    => 'high',
            'start_date'  => Carbon::now(),
            'user_id'     => 1,
        ]);
    }
}
