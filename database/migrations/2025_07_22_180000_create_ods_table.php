<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_ods_table.php
public function up(): void
{
    Schema::create('ods', function (Blueprint $table) {
        $table->id();
        $table->integer('codigo')->unique();
        $table->string('descripcion', 200);
        $table->integer('meta');              // número del objetivo ODS (1-17)
        $table->string('nombre', 120);
        $table->timestamps();
    });
}
public function down(): void
{
    Schema::dropIfExists('ods');
}

};
