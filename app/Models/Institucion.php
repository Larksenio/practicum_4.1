<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Institucion extends Model
{
    use HasFactory;

    protected $table      = 'instituciones';
    protected $primaryKey = 'idInstitucion';
    protected $keyType    = 'int';
    public    $incrementing = true;
    public    $timestamps   = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'subsector',
        'nivel_gobierno',
        'parent_id',
        'estado',
        'fecha_creacion',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    /** Para que el route-model binding use la PK correcta */
    public function getRouteKeyName(): string
    {
        return 'idInstitucion';
    }

    /* ──────────── Relaciones ──────────── */
    public function padre(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'idInstitucion');
    }

    public function hijos(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'idInstitucion');
    }

    /* ──────────── Scopes ──────────── */
    public function scopeActivas($q)
    {
        return $q->where('estado', 'activo');
    }
}
