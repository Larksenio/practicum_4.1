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
       Schema::create('pnd_ejes', function (Blueprint $table) {
    $table->id();
    $table->string('nombre', 80)->unique(); // Social, Económico, etc.
    $table->string('descripcion', 200)->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_ejes');
    }
};
