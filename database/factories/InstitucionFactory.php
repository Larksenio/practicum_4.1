<?php


namespace Database\Factories;

use App\Models\Institucion;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitucionFactory extends Factory
{
    protected $model = Institucion::class;

    public function definition(): array
    {
        return [
            'codigo'   => $this->faker->unique()->numberBetween(1000, 9999),
            'nombre'   => $this->faker->company,
            'estado'   => 'activo',
            // agrega los demás campos que sean fillable
        ];
    }
}
