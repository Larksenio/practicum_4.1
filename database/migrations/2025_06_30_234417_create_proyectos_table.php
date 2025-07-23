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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->integer('codigo')->unique();
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->string('estado'); 
            $table->string('actividades'); 
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('tipologia');
            $table->unsignedBigInteger('idInstitucion');          
            $table->timestamps();

            $table->foreign('idInstitucion')->references('idInstitucion')->on('instituciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
