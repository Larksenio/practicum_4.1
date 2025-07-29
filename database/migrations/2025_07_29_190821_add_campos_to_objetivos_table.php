<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            // datos básicos
            $table->unsignedInteger('codigo')->unique()->after('id');
            $table->string('descripcion',255)->after('codigo');
            $table->enum('estado',['activo','inactivo'])
                  ->default('activo')->after('descripcion');
            $table->unsignedTinyInteger('version')->default(1)->after('estado');
            $table->date('fecha_registro')->nullable()->after('version');

            // relaciones (si ya existen las tablas pnds / ods)
            $table->foreignId('pnd_id')->nullable()
                  ->constrained('pnds')->onDelete('set null');
            $table->foreignId('ods_id')->nullable()
                  ->constrained('ods')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            $table->dropForeign(['pnd_id']);
            $table->dropForeign(['ods_id']);
            $table->dropColumn([
                'codigo','descripcion','estado','version',
                'fecha_registro','pnd_id','ods_id',
            ]);
        });
    }
};
