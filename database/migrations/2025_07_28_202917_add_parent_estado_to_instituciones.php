<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')
                  ->nullable()
                  ->after('idInstitucion');

            $table->enum('estado', ['activo','inactivo'])
                  ->default('activo')
                  ->change();   // ← si “estado” ya existe como VARCHAR

            $table->foreign('parent_id')
                  ->references('idInstitucion')->on('instituciones')
                  ->nullOnDelete();

            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->string('estado',255)->change();
        });
    }
};
