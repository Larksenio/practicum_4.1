<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Entidad;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntidadTest extends TestCase
{
   
    use RefreshDatabase;
    /**
     * @test
     */
    public function  puede_crear_una_entidad()
    {
        
        
        $entidad = Entidad::create([
            'codigo'=>1001,
            'subSector'=>'Salud',
            'nivelGobierno'=>'Nacional',
            'estado'=>'Activo',
            'fechaCreacion'=>now()->toDateString(),
            'fechaActualizacion'=>now()->toDateString()
        ]);

        $this->assertDatabaseHas('entidades',[
             'codigo'=>1001,
            'estado'=>'Activo',
        ]);
        
    }
}
