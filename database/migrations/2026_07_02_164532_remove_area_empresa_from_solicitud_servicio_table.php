<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->dropColumn('area_empresa');
        });
    }

    public function down(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->string('area_empresa', 150)->nullable()->after('solicitante');
        });
    }
};
