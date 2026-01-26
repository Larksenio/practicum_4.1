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
      Schema::create('ods_metas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('ods_id')->constrained('ods')->cascadeOnDelete();

    $table->string('codigo', 10);          // 1.1, 1.2, 1.a
    $table->string('descripcion', 500);    // texto de la meta

    $table->timestamps();

    $table->unique(['ods_id','codigo']); // no repetir 1.1 dentro del mismo ODS
});

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ods_metas');
    }
};
