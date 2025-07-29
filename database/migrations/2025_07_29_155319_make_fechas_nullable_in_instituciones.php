<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            $table->date('fecha_creacion')->nullable()->change();
            $table->date('fecha_actualizacion')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            $table->date('fecha_creacion')->nullable(false)->change();
            $table->date('fecha_actualizacion')->nullable(false)->change();
        });
    }
};
