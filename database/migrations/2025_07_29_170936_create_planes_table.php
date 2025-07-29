<?php

// database/migrations/2025_07_30_000000_create_planes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id('idPlan');
            $table->foreignId('programa_id')
                  ->constrained('programas', 'idPrograma')
                  ->cascadeOnDelete();
            $table->integer('codigo');
            $table->integer('version')->default(1);
            $table->string('nombre',255);
            $table->text('descripcion')->nullable();
            $table->enum('estado',['activo','inactivo'])->default('activo');
            $table->timestamps();

            $table->unique(['programa_id','codigo','version']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};