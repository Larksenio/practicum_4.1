<?php
// database/migrations/xxxx_xx_xx_alter_instituciones_for_hierarchy.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            // jerarquía
            $table->unsignedBigInteger('parent_id')->nullable()->after('idInstitucion');
            $table->foreign('parent_id')
                  ->references('idInstitucion')->on('instituciones')
                  ->nullOnDelete();

            // enum estado
            $table->enum('estado', ['activo','inactivo'])
                  ->default('activo')->change();

            // índices únicos
            $table->unique('codigo');
            $table->unique('nombre');

            // índice jerarquía
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::table('instituciones', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropIndex(['parent_id']);
            $table->dropUnique(['codigo']);
            $table->dropUnique(['nombre']);
            $table->dropColumn('parent_id');
            $table->string('estado',255)->change();
        });
    }
};
