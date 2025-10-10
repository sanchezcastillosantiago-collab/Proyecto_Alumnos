<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->safeEmail(),
            'codigo' => $this->faker->unique()->numerify('ALU#####'),
            'fecha_nacimiento' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'carrera' => $this->faker->randomElement([
                'Ingeniería en Sistemas',
                'Ingeniería Industrial',
                'Ingeniería Civil',
                'Arquitectura',
                'Medicina',
                'Derecho',
                'Administración de Empresas',
                'Contabilidad',
                'Psicología',
                'Educación',
            ]),
        ];
    }
}
