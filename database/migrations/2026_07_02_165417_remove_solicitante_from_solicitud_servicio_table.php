<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->dropColumn('solicitante');
        });
    }

    public function down(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->string('solicitante', 150)->nullable()->after('id_usuario');
        });
    }
};
