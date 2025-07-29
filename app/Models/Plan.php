<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $table      = 'planes';   

    protected $primaryKey = 'idPlan';

    protected $fillable = [
        'programa_id','codigo','version',
        'nombre','descripcion','estado',
    ];

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
    public function scopeActivos($q) { return $q->where('estado','activo'); }
}
