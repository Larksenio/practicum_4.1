<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $fillable = [
        'nombre','tipo','antecedentes','desarrollo',
        'conclusiones','fecha_creacion','responsable_id',
    ];

    /* Relaciones */
    public function responsable() { return $this->belongsTo(User::class, 'responsable_id'); }
    public function informes()    { return $this->hasMany(Informe::class);                }
}
