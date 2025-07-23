<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $fillable = [
        'codigo','descripcion','version',
        'fecha_registro','pnd_id','ods_id',
    ];

    // Indica a Eloquent qué columnas usar
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'updated_at';
}