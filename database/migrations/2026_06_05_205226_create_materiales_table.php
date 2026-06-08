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
        Schema::create('material', function (Blueprint $table) {
            $table->id('id_material');
            $table->unsignedBigInteger('id_categoria');
            $table->string('nombre_material', 150);
            $table->string('unidad_medida', 50);
            $table->decimal('stock_actual', 10, 2)->default(0);
            $table->decimal('stock_minimo', 10, 2)->default(0);
            $table->decimal('precio_unitario', 10, 2)->default(0);
            $table->string('ubicacion', 150)->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamps();
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria_material');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material');
    }
};
