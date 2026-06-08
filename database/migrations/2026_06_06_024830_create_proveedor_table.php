<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('ruc', 20);
            $table->string('razon_social', 200);
            $table->string('contacto', 150)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamps();
            $table->unique('ruc');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};
