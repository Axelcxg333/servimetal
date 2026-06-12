<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id('id_notificacion');
            $table->unsignedBigInteger('usuario_id');
            $table->string('tipo', 50);
            $table->string('titulo', 200);
            $table->text('mensaje');
            $table->unsignedBigInteger('relacionable_id')->nullable();
            $table->string('relacionable_type')->nullable();
            $table->boolean('leida')->default(false);
            $table->timestamp('leida_en')->nullable();
            $table->timestamps();

            $table->index(['usuario_id', 'leida']);
            $table->index(['relacionable_type', 'relacionable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
