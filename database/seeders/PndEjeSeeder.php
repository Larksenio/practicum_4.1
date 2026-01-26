<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PndEje;

class PndEjeSeeder extends Seeder
{
    public function run(): void
    {
        $ejes = [
            ['nombre' => 'Social', 'descripcion' => null],
            ['nombre' => 'Económico', 'descripcion' => null],
            ['nombre' => 'Infraestructura/Energía/Medio Ambiente', 'descripcion' => null],
            ['nombre' => 'Institucional', 'descripcion' => null],
        ];

        foreach ($ejes as $eje) {
            PndEje::firstOrCreate(['nombre' => $eje['nombre']], $eje);
        }
    }
}

