<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Seccion::factory()->count(20)->create();
    }
}
