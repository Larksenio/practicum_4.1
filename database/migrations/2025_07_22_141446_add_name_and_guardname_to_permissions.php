<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Añade las columnas faltantes a la tabla permissions
     * - name         → string
     * - guard_name   → string, por defecto 'web'
     */
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Si la tabla fue creada por otro paquete puede no tener estas columnas
            if (! Schema::hasColumn('permissions', 'name')) {
                $table->string('name')->after('id');
            }

            if (! Schema::hasColumn('permissions', 'guard_name')) {
                $table->string('guard_name')->default('web')->after('name');
            }
        });
    }

    /**
     * Revierte los cambios (solo si existen las columnas).
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            if (Schema::hasColumn('permissions', 'guard_name')) {
                $table->dropColumn('guard_name');
            }

            if (Schema::hasColumn('permissions', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
