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
        Schema::create('movimiento_inventario', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->unsignedBigInteger('id_material');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('tipo_movimiento', ['ENTRADA', 'SALIDA']);
            $table->decimal('cantidad', 10, 2);
            $table->dateTime('fecha_movimiento')->useCurrent();
            $table->string('motivo', 255)->nullable();
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->foreign('id_material')->references('id_material')->on('material');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventario');
    }
};
