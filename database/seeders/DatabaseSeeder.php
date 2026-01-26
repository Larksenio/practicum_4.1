<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
             PndEjeSeeder::class,  
            RoleSeeder::class,        // 1) crea/actualiza roles
            PermissionSeeder::class,  // 2) permisos y asignación
            AdminUserSeeder::class,   // 3) super-admin (usa rol ya creado)
        ]);
    }
}