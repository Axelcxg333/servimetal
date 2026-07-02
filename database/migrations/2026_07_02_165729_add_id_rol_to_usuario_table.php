<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rol')->nullable()->after('correo');
        });

        DB::statement("UPDATE usuario SET id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = usuario.rol)");

        Schema::table('usuario', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rol')->nullable(false)->change();
            $table->foreign('id_rol')->references('id_rol')->on('rol');
            $table->dropColumn('rol');
        });
    }

    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->string('rol', 50)->nullable()->after('correo');
        });

        DB::statement("UPDATE usuario SET rol = (SELECT nombre_rol FROM rol WHERE id_rol = usuario.id_rol)");

        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign(['id_rol']);
            $table->dropColumn('id_rol');
        });
    }
};
