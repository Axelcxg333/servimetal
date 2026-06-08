<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->string('solicitante', 150)->nullable()->after('id_usuario');
            $table->string('area_empresa', 150)->nullable()->after('solicitante');
            $table->enum('prioridad', ['ALTA', 'MEDIA', 'BAJA'])->default('MEDIA')->after('detalle');
            $table->date('fecha_requerida')->nullable()->after('fecha_solicitud');
        });

        DB::statement("ALTER TABLE solicitud_servicio MODIFY estado ENUM('PENDIENTE','EN_PROCESO','ATENDIDA','FINALIZADO','CANCELADO') NOT NULL DEFAULT 'PENDIENTE'");
    }

    public function down(): void
    {
        Schema::table('solicitud_servicio', function (Blueprint $table) {
            $table->dropColumn(['solicitante', 'area_empresa', 'prioridad', 'fecha_requerida']);
        });
        DB::statement("ALTER TABLE solicitud_servicio MODIFY estado ENUM('PENDIENTE','EN_PROCESO','FINALIZADO','CANCELADO') NOT NULL DEFAULT 'PENDIENTE'");
    }
};
