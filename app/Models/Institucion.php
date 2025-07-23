<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institucion extends Model
{
    use HasFactory;

    protected $primaryKey='idInstitucion';
    public $timestamps = false;
    protected $table = 'instituciones';

    protected $fillable =[
        'codigo',
        'nombre',
        'subsector',
        'nivel_gobierno',
        'estado',
        'fecha_creacion',
        'fecha_actualizacion'
    ];

    /**
     * Relación 1:N - Una institucion tiene muchos proyectos
     */

     public function proyectos():HasMany
     {
        return $this->hasMany(Proyecto::class,'idInstitucion','idInstitucion');
     }
}
