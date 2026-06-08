<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa', 200);
            $table->string('ruc', 20);
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->decimal('stock_min_global', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
