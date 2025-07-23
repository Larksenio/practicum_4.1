<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnd extends Model
{
    protected $fillable = ['codigo','descripcion','eje','nombre'];

    // Relación inversa con Objetivo (uno-a-muchos)
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}
