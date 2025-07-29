<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\{Permission, Role};
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        /* -----------------------------------------------------------------
         * 1) Limpiar caché de permisos
         * ----------------------------------------------------------------*/
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /* -----------------------------------------------------------------
         * 2) Catálogo de permisos (CRUD por módulo)
         * ----------------------------------------------------------------*/
        $permisos = collect([
            // ─── Usuarios ───
            'users.view', 'users.create', 'users.edit', 'users.delete',

            // ─── Instituciones ───
            'instituciones.view', 'instituciones.create',
            'instituciones.edit', 'instituciones.delete',

            // ─── Programas ───
            'programas.view', 'programas.create',
            'programas.edit', 'programas.delete',

            // ─── Proyectos ───
            'proyectos.view', 'proyectos.create',
            'proyectos.edit', 'proyectos.delete',

            // ─── Planes ───
            'planes.view', 'planes.create',
            'planes.edit', 'planes.delete',

            // ─── Objetivos ───
            'objetivos.view', 'objetivos.create',
            'objetivos.edit', 'objetivos.delete',

            // ─── Reportes ───
            'reportes.view', 'reportes.export',
            'alinear.view', 'alinear.update',
        ]);

        /* Crear cada permiso si no existe */
        $permisos->each(fn (string $p) =>
            Permission::firstOrCreate(['name'=>$p,'guard_name'=>'web'])
        );

        /* -----------------------------------------------------------------
         * 3) Asignar permisos a roles
         * ----------------------------------------------------------------*/
        $roles = Role::whereIn('name', [
                    'admin','auditor','planificador','supervisor','user'
                 ])->get()->keyBy('name');

        $sync = fn(string $rol, array|Collection $perms) =>
            optional($roles[$rol] ?? null)->syncPermissions($perms);

        /* Admin → todos */
        $sync('admin', Permission::all());

        /* Auditor */
        $sync('auditor', [
            'reportes.view','reportes.export','users.view',
        ]);

        /* Planificador */
        $sync('planificador', [
            // lectura de catálogos
            'instituciones.view','programas.view','proyectos.view',
            'planes.view','objetivos.view',

            // alta / edición
            'programas.create','programas.edit',
            'proyectos.create','proyectos.edit',
            'planes.create','planes.edit',
             'planes.view','planes.create','planes.edit',
             'alinear.view','alinear.update'
        ]);

        /* Supervisor (solo lectura proyectos / reportes) */
        $sync('supervisor', [
            'proyectos.view','reportes.view','alinear.view'
        ]);

        /* User (lectura básica) */
        $sync('user', [
            'instituciones.view','programas.view','proyectos.view',
        ]);
    }
}

