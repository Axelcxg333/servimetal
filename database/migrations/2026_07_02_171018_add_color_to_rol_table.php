<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rol', function (Blueprint $table) {
            $table->string('color', 20)->nullable()->after('descripcion');
        });

        DB::table('rol')->where('nombre_rol', 'ADMINISTRADOR')->update(['color' => '#dc3545']);
        DB::table('rol')->where('nombre_rol', 'TECNICO')->update(['color' => '#198754']);
    }

    public function down(): void
    {
        Schema::table('rol', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
