<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('material', function (Blueprint $table) {
            $table->unsignedBigInteger('id_unidad')->nullable()->after('unidad_medida');
        });

        DB::statement("UPDATE material m LEFT JOIN unidad_medida u ON m.unidad_medida = u.nombre_unidad SET m.id_unidad = u.id_unidad");

        Schema::table('material', function (Blueprint $table) {
            $table->dropColumn('unidad_medida');
        });

        Schema::table('material', function (Blueprint $table) {
            $table->unsignedBigInteger('id_unidad')->nullable(false)->default(1)->change();
        });
    }

    public function down(): void
    {
        Schema::table('material', function (Blueprint $table) {
            $table->string('unidad_medida', 50)->nullable()->after('id_unidad');
        });

        DB::statement("UPDATE material m LEFT JOIN unidad_medida u ON m.id_unidad = u.id_unidad SET m.unidad_medida = u.nombre_unidad");

        Schema::table('material', function (Blueprint $table) {
            $table->dropColumn('id_unidad');
        });
    }
};
