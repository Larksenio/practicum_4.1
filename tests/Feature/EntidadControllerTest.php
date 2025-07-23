<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Entidad;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntidadControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function muestra_el_listado_de_entidades()
    {
        Entidad::factory()->create(['codigo' => 2001]);

        $response = $this->get('/entidades');
        $response->assertStatus(200);
        $response->assertSee('2001');
    }

    /** @test */
    public function puede_guardar_una_entidad()
    {
        $response = $this->post('/entidades', [
            'codigo' => 3001,
            'subSector' => 'Salud',
            'nivelGobierno' => 'Provincial',
            'estado' => 'Activo',
            'fechaCreacion' => now()->toDateString(),
            'fechaActualizacion' => now()->toDateString(),
        ]);

        $response->assertRedirect('/entidades');
        $this->assertDatabaseHas('entidades', ['codigo' => 3001]);
    }
}