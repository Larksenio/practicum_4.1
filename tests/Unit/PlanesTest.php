<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Programa;   // FK hacia planes
use App\Models\Plan;       // modelo Plan (POA)
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_plan(): void
    {
        /* 1) Debe existir un programa (FK) ---------------------------- */
        $programa = Programa::factory()->create([
            'codigo' => 7001,
            'nombre' => 'Programa de Salud Digital',
            'estado' => 'activo',
        ]);

        /* 2) Datos mínimos + obligatorios del Plan -------------------- */
        $payload = [
            'idPrograma'   => $programa->idPrograma,          // FK exacta
            'codigo'       => 90001,
            'nombre'       => 'POA 2026 – Salud Digital',
            'estado'       => 'activo',
            'fecha_inicio' => now()->toDateString(),
            'fecha_fin'    => now()->addYear()->toDateString(),
            'presupuesto'  => 2_000_000,                     // si tu tabla lo exige
        ];

        /* 3) Creación -------------------------------------------------- */
        $plan = Plan::create($payload);

        /* 4) Afirmaciones --------------------------------------------- */
        $this->assertDatabaseHas('planes', [
            'idPlan'      => $plan->idPlan,
            'codigo'      => 90001,
            'idPrograma'  => $programa->idPrograma,
        ]);
    }
}
