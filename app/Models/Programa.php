<?php

// app/Models/Programa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programa extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPrograma';

    protected $fillable = [
        'institucion_id',
        'nombre',
        'descripcion',
        'estado',
    ];

    /* Relaciones */
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucion_id', 'idInstitucion');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'programa_id', 'idPrograma');
    }

    /* Scope */
    public function scopeActivos($q) { return $q->where('estado','activo'); }
}
