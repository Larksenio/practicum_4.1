<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntidadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(1000, 9999),
            'subSector' => $this->faker->word(),
            'nivelGobierno' => $this->faker->randomElement(['Nacional', 'Provincial', 'Municipal']),
            'estado' => 'Activo',
            'fechaCreacion' => now()->toDateString(),
            'fechaActualizacion' => now()->toDateString(),
        ];
    }
}