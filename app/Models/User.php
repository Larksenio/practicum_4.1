<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /*---------------------------------------------------------------------
    | ATRIBUTOS
    ---------------------------------------------------------------------*/
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /*---------------------------------------------------------------------
    | HOOKS - Asigna rol por defecto al crear usuario
    ---------------------------------------------------------------------*/
    protected static function booted(): void
    {
        static::created(function (self $user) {
            // Si no tiene ningún rol, asígnale 'user'
            if ($user->roles()->count() === 0) {
                $user->assignRole('user');
            }
        });
    }

    /*---------------------------------------------------------------------
    | MÉTODOS AUXILIARES
    ---------------------------------------------------------------------*/
    /**
     * Alias retro-compatible para asignar un rol (setRole → assignRole)
     *
     * @param  string|\Spatie\Permission\Models\Role|array  $role
     * @return $this
     */
    public function setRole($role): self
    {
        return $this->assignRole($role);
    }
}