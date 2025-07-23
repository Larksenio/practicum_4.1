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
        Schema::create('reportes', function (Blueprint $table) {
    $table->id();                             // id
    $table->string('nombre');                 // Ej: “Reporte anual”
    $table->string('tipo');                   // PDF, Excel, etc.
    $table->text('antecedentes')->nullable();
    $table->text('desarrollo')->nullable();
    $table->text('conclusiones')->nullable();
    $table->date('fecha_creacion')->default(now());
    $table->unsignedBigInteger('responsable_id');
    $table->foreign('responsable_id')->references('id')->on('users');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
