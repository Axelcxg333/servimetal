<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permisoId = DB::table('permiso')->insertGetId([
            'llave' => 'servicios',
            'nombre' => 'Servicios',
            'grupo' => 'Configuración',
            'orden' => 15,
        ]);

        $adminId = DB::table('rol')->where('nombre_rol', 'ADMINISTRADOR')->value('id_rol');
        DB::table('permiso_rol')->insert([
            'id_permiso' => $permisoId,
            'id_rol' => $adminId,
        ]);
    }

    public function down(): void
    {
        $p = DB::table('permiso')->where('llave', 'servicios')->first();
        if ($p) {
            DB::table('permiso_rol')->where('id_permiso', $p->id_permiso)->delete();
            DB::table('permiso')->where('id_permiso', $p->id_permiso)->delete();
        }
    }
};
