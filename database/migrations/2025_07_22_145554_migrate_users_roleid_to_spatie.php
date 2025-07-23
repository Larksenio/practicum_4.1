<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
{
    // 1) Copia datos a model_has_roles  (esto ya lo tenías)
    $users = DB::table('users')
              ->whereNotNull('role_id')
              ->select('id', 'role_id')
              ->get();

    foreach ($users as $user) {
        DB::table('model_has_roles')->updateOrInsert(
            [
                'role_id'    => $user->role_id,
                'model_type' => \App\Models\User::class,
                'model_id'   => $user->id,
            ]
        );
    }

    // 2) Quitar clave foránea y la columna role_id (si existe)
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'role_id')) {

            // a) Suelta la FK (ajusta el nombre si es distinto)
            $table->dropForeign('users_role_id_foreign');

            // b) Ahora sí, elimina la columna
            $table->dropColumn('role_id');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (! Schema::hasColumn('users', 'role_id')) {
            $table->unsignedBigInteger('role_id')->nullable()->after('id');

            // (re)crear la FK si quieres
            // $table->foreign('role_id')->references('id')->on('roles')->nullOnDelete();
        }
    });
}

};

