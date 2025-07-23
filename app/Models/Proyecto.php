<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Proyecto extends Model
{
    use HasFactory;

    protected $primaryKey='idProyecto';
    protected $table = 'proyectos';

    protected $fillable =[
        'codigo',
        'nombre',
        'descripcion',
        'estado',
        'actividades',
        'fecha_inicio',
        'fecha_fin',
        'tipologia', 
        'idInstitucion',  
    ];

    /**
     * Relación 1:N - Un proyecto pertenece a una institucion
     */

     public function institucion():BelongsTo
     {
        return $this->belongsTo(Institucion::class,'idInstitucion','idInstitucion');
     }
}
