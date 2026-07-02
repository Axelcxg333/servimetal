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
        Schema::table('configuracion', function (Blueprint $table) {
            $table->dropColumn('stock_min_global');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuracion', function (Blueprint $table) {
            $table->decimal('stock_min_global', 10, 2)->default(0);
        });
    }
};
