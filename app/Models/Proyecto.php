<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';
    protected $primaryKey = 'idProyecto';

    protected $fillable = [
        'idInstitucion',
        'codigo',
        'nombre',
        'descripcion',
        'estado',
        'actividades',
        'fecha_inicio',
        'fecha_fin',
        'tipologia',
    ];

    public function institucion(): BelongsTo
    {
        return $this->belongsTo(Institucion::class, 'idInstitucion', 'idInstitucion');
    }

    public function objetivos()
    {
        return $this->belongsToMany(
            Objetivo::class,
            'objetivo_proyecto',
            'proyecto_id',
            'objetivo_id'
        );
    }
}
