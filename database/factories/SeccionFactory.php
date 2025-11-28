<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seccion>
 */
class SeccionFactory extends Factory
{
    public function definition(): array
    {
        $letters = ['A','B','C','D','E'];
        return [
            'seccion' => 'Sección ' . $this->faker->randomElement($letters),
            'aula' => 'Aula ' . $this->faker->numberBetween(1, 40),
        ];
    }
}
