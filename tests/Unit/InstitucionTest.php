<?php
/**
 * tests/Unit/InstitucionTest.php
 *
 * Verifica que el modelo Institucion pueda persistir
 * y que exista la fila en la base de datos.
 */
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Institucion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstitucionTest extends TestCase
{
    use RefreshDatabase;   // ejecuta migraciones en la BD de pruebas

    /** @test */
    public function puede_crear_una_institucion(): void
    {
        // Act – creamos el registro
        $inst = Institucion::create([
            'codigo'         => 1001,
            'nombre'         => 'Ministerio de Salud',
            'subsector'      => 'Salud',
            'nivel_gobierno' => 'Nacional',
            'estado'         => 'activo',
        ]);

        // Assert – la fila está en la tabla `instituciones`
        $this->assertDatabaseHas('instituciones', [
            'codigo' => 1001,
            'nombre' => 'Ministerio de Salud',
            'estado' => 'activo',
        ]);

        // Optionally, assert the returned model matches
        $this->assertSame(1001, $inst->codigo);
    }
}
