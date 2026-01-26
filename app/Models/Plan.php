<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes';

    protected $primaryKey = 'idPlan';

    // Si tu idPlan es autoincrement int (normalmente sí)
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'programa_id',
        'codigo',
        'version',
        'nombre',
        'descripcion',
        'estado',
    ];

    /**
     * Route model binding:
     * Cuando la ruta sea /planes/{plan} Laravel buscará por idPlan.
     */
    public function getRouteKeyName()
    {
        return 'idPlan';
    }

    /* Relaciones */
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id', 'idPrograma');
    }

    public function objetivos()
    {
        return $this->hasMany(Objetivo::class, 'plan_id', 'idPlan');
    }

    /* Scope */
    public function scopeActivos($q)
    {
        return $q->where('estado', 'activo');
    }
}
