<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $fillable = ['codigo','version','reporte_id'];

    public function reporte() { return $this->belongsTo(Reporte::class); }
}

