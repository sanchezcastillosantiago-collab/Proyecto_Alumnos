<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create or update a test admin user so you can log in locally.
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'role' => 'admin',
                'password' => Hash::make('contraseña'),
                'must_change_password' => true,
            ]
        );

        // Seed some example secciones if none exist
        if (\App\Models\Seccion::count() === 0) {
            \App\Models\Seccion::factory()->count(3)->create();
        }

        // Create 15 additional alumnos
        \App\Models\Alumno::factory()->count(15)->create();

        // Create 20 tareas (will assign to existing users or create users as needed)
        \App\Models\Tarea::factory()->count(20)->create();
    }
}
