<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;    // ←  IMPORTA Role
use App\Models\User;                  // ←  IMPORTA User
use Illuminate\Support\Facades\Hash;  // ←  IMPORTA Hash

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // crea (o recupera) el rol admin
        $role = Role::firstOrCreate(['name' => 'admin']);

        // crea (o actualiza) el usuario
        $user = User::firstOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name'     => 'Super',
                'password' => Hash::make('12345678'),   // cámbiala luego
            ],
        );

        // asigna el rol admin
        $user->syncRoles([$role]);
    }
}