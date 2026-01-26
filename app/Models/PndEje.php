<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PndEje extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion'];

    public function pnds()
    {
        return $this->hasMany(Pnd::class, 'eje_id');
    }
}
