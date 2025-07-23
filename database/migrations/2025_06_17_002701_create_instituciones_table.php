<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id('idInstitucion');
            $table->integer('codigo')->unique();
            $table->string('nombre');
            $table->string('subsector');
            $table->string('nivel_gobierno');
            $table->string('estado');
            $table->date('fecha_creacion');
            $table->date('fecha_actualizacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
