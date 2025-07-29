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
        $roles = ['admin','user','auditor','planificador','supervisor'];

        foreach ($roles as $name) {
            Role::firstOrCreate(
                ['name' => $name, 'guard_name' => 'web']
            );
        }
    }
}
