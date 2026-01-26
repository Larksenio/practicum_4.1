<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    use HasFactory;

    // Si tu tabla NO tiene created_at/updated_at, desactívalos
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'descripcion',
        'estado',
        'version',
        'fecha_registro',
        'pnd_id',
        'ods_id',
    ];

    /* Scopes */
    public function scopeActivos($q)
    {
        return $q->where('estado', 'ACTIVO'); // consistente con tus selects y validación
    }

    /* Relaciones */
    public function pnd()
    {
        return $this->belongsTo(Pnd::class, 'pnd_id');
    }

    public function ods()
    {
        return $this->belongsTo(Ods::class, 'ods_id');
    }
}
