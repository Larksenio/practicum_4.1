<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('objetivo_proyecto', function (Blueprint $table) {
            $table->foreignId('proyecto_id')
                  ->constrained('proyectos', 'idProyecto')
                  ->cascadeOnDelete();

            $table->foreignId('objetivo_id')
                  ->constrained('objetivos')
                  ->cascadeOnDelete();

            $table->primary(['proyecto_id','objetivo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objetivo_proyecto');
    }
};
