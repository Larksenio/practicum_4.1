<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OdsMeta extends Model
{
    protected $table = 'ods_metas';
    protected $fillable = ['ods_id','codigo','descripcion'];

    public function ods()
    {
        return $this->belongsTo(Ods::class, 'ods_id');
    }
}

