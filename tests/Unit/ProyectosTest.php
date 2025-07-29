<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Proyecto;
use App\Models\Institucion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProyectosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_proyecto(): void
    {
        /* 1) Institución obligatoria ----------------------------------- */
        $inst = Institucion::factory()->create([
            'codigo'         => 2025,
            'nombre'         => 'Ministerio de Salud',
            'subsector'      => 'Salud',
            'nivel_gobierno' => 'Nacional',
            'estado'         => 'activo',
        ]);

        /* 2) Datos del proyecto (TODOS los NOT-NULL) ------------------- */
        $payload = [
            'idInstitucion' => $inst->idInstitucion,           // ← FK
            'codigo'        => 51001,
            'nombre'        => 'Historia Clínica Electrónica',
            'descripcion'   => 'Plataforma nacional de HC',
            'estado'        => 'activo',
            'actividades'   => 'Análisis, desarrollo, capacitación',
            'fecha_inicio'  => now()->toDateString(),
            'fecha_fin'     => now()->addMonths(6)->toDateString(),
            'tipologia'     => 'Tecnología',
        ];

        $proyecto = Proyecto::create($payload);

        /* 3) Afirmaciones ---------------------------------------------- */
        $this->assertDatabaseHas('proyectos', [
            'idProyecto'    => $proyecto->idProyecto,
            'codigo'        => 51001,
            'idInstitucion' => $inst->idInstitucion,
        ]);
    }
}
