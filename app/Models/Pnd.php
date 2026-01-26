<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnd extends Model
{
    use HasFactory;

    protected $fillable = ['codigo','descripcion','nombre','eje_id'];

    public function eje()
    {
        return $this->belongsTo(PndEje::class, 'eje_id');
    }
}
