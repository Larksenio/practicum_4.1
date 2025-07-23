<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Ods.php
class Ods extends Model
{
    protected $fillable = ['codigo','descripcion','meta','nombre'];

    // Relación con Objetivo (uno a muchos)
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }
}

