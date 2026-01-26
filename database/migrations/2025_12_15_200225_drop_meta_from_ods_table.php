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
        Schema::table('ods', function (Blueprint $table) {
    $table->dropColumn('meta');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ods', function (Blueprint $table) {
            //
        });
    }
};
