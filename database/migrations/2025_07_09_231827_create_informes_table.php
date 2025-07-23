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
       Schema::create('informes', function (Blueprint $table) {
    $table->id();
    $table->string('codigo');                 // ej: REP-2024-001
    $table->integer('version')->default(1);
    $table->foreignId('reporte_id')->constrained('reportes')->cascadeOnDelete();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informes');
    }
};
