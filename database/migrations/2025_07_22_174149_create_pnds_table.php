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
    Schema::create('pnds', function (Blueprint $table) {
        $table->id();
        $table->integer('codigo')->unique();
        $table->string('descripcion', 200);
        $table->string('eje', 50);
        $table->string('nombre', 120);
        $table->timestamps();
    });
}
public function down(): void
{
    Schema::dropIfExists('pnds');
}
};
