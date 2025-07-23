<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Crea -o actualiza si ya existen- todos los roles necesarios.
     */
    public function run(): void
    {
        $roles = [
            // existentes
            'admin',
            'user',

            // ─── nuevos ───
            'auditor',
            'planificador',
            'usuario_externo',
            'supervisor',
        ];

        foreach ($roles as $name) {
            Role::firstOrCreate(
                ['name' => $name, 'guard_name' => 'web']
            );
        }
    }
}
