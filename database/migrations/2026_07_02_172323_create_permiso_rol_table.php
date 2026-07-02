<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('permiso_rol')) {
            Schema::create('permiso_rol', function (Blueprint $table) {
                $table->id('id_permiso_rol');
                $table->unsignedBigInteger('id_permiso');
                $table->unsignedBigInteger('id_rol');
                $table->timestamps();
                $table->unique(['id_permiso', 'id_rol']);
                $table->foreign('id_permiso')->references('id_permiso')->on('permiso')->onDelete('cascade');
                $table->foreign('id_rol')->references('id_rol')->on('rol')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permiso_rol');
    }
};
