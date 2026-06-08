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
        Schema::create('solicitud_servicio', function (Blueprint $table) {
            $table->id('id_solicitud');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_servicio');
            $table->unsignedBigInteger('id_usuario');
            $table->dateTime('fecha_solicitud')->useCurrent();
            $table->text('detalle')->nullable();
            $table->enum('estado', ['PENDIENTE', 'EN_PROCESO', 'FINALIZADO', 'CANCELADO'])->default('PENDIENTE');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->foreign('id_servicio')->references('id_servicio')->on('servicio');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_servicio');
    }
};
