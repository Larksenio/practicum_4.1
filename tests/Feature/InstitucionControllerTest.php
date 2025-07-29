<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Institucion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstitucionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** Helpers ────────────────────────────────────────────────────────── */
    private function actingAsAdmin(): self
    {
        $admin = User::factory()->create()->assignRole('admin');
        return $this->actingAs($admin);                 // chain-able
    }

    /** @test */
    public function index_muestra_el_listado_de_instituciones()
    {
        // Arrange
        Institucion::factory()->create(['codigo' => 2001]);

        // Act
        $response = $this->actingAsAdmin()->get(route('instituciones.index'));

        // Assert
        $response->assertOk()
                 ->assertSee('2001');
    }

    /** @test */
    public function store_puede_guardar_una_institucion()
    {
        // Arrange: payload válido
        $payload = [
            'codigo'          => 3001,
            'nombre'          => 'Ministerio de Salud',
            'subsector'       => 'Salud',
            'nivel_gobierno'  => 'Provincial',
            'estado'          => 'activo',
            // los campos fecha_* son opcionales (nullable) en la migración
        ];

        // Act
        $response = $this->actingAsAdmin()
                         ->post(route('instituciones.store'), $payload);

        // Assert
        $response->assertRedirect(route('instituciones.index'));
        $this->assertDatabaseHas('instituciones', [
            'codigo' => 3001,
            'nombre' => 'Ministerio de Salud',
        ]);
    }
}
