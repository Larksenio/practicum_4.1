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
        Schema::table('pnds', function (Blueprint $table) {
    // 1) agregar eje_id
    $table->foreignId('eje_id')->after('descripcion')->constrained('pnd_ejes');

    // 2) eliminar columna eje
    $table->dropColumn('eje');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pnds', function (Blueprint $table) {
    $table->string('eje', 50)->after('descripcion');
    $table->dropConstrainedForeignId('eje_id');
});

    }
};
