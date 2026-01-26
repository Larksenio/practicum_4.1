<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ods extends Model
{
    use HasFactory;

    // OJO: ya NO va 'meta' aquí, porque metas están en otra tabla
    protected $fillable = ['codigo','descripcion','nombre'];

    // Relación con Objetivo (uno a muchos)
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class,'ods_id');
    }

    // ✅ Relación con Metas del ODS (uno a muchos)
    public function metas()
    {
        return $this->hasMany(OdsMeta::class, 'ods_id');
    }
}
