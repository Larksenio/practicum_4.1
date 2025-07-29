<?php

// database/migrations/2025_07_29_000000_create_programas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id('idPrograma');
            $table->foreignId('institucion_id')
                  ->constrained('instituciones', 'idInstitucion')
                  ->cascadeOnDelete();
            $table->string('nombre', 255);
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['activo','inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
