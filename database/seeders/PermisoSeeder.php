<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            ['llave' => 'dashboard',      'nombre' => 'Dashboard',           'grupo' => 'General',      'orden' => 1],
            ['llave' => 'materiales',     'nombre' => 'Materiales',          'grupo' => 'Inventario',   'orden' => 2],
            ['llave' => 'entradas',       'nombre' => 'Entradas',            'grupo' => 'Inventario',   'orden' => 3],
            ['llave' => 'salidas',        'nombre' => 'Salidas',             'grupo' => 'Inventario',   'orden' => 4],
            ['llave' => 'solicitudes',    'nombre' => 'Solicitudes',         'grupo' => 'Operaciones',  'orden' => 5],
            ['llave' => 'proveedores',    'nombre' => 'Proveedores',         'grupo' => 'Operaciones',  'orden' => 6],
            ['llave' => 'reportes',       'nombre' => 'Reportes',            'grupo' => 'Operaciones',  'orden' => 7],
            ['llave' => 'notificaciones', 'nombre' => 'Notificaciones',      'grupo' => 'General',      'orden' => 8],
            ['llave' => 'categorias',     'nombre' => 'Categorías',          'grupo' => 'Configuración','orden' => 9],
            ['llave' => 'unidades',       'nombre' => 'Unidades de medida',  'grupo' => 'Configuración','orden' => 10],
            ['llave' => 'roles',          'nombre' => 'Roles y Accesos',     'grupo' => 'Configuración','orden' => 11],
            ['llave' => 'usuarios',       'nombre' => 'Usuarios',            'grupo' => 'Configuración','orden' => 12],
            ['llave' => 'clientes',       'nombre' => 'Clientes',            'grupo' => 'Operaciones',  'orden' => 13],
            ['llave' => 'configuracion',  'nombre' => 'Configuración',       'grupo' => 'Configuración','orden' => 14],
        ];

        DB::table('permiso')->insert($permisos);

        // ADMINISTRADOR obtiene todos los permisos
        $adminId = DB::table('rol')->where('nombre_rol', 'ADMINISTRADOR')->value('id_rol');
        $allPermisos = DB::table('permiso')->pluck('id_permiso');
        foreach ($allPermisos as $pid) {
            DB::table('permiso_rol')->insert([
                'id_permiso' => $pid,
                'id_rol' => $adminId,
            ]);
        }

        // TECNICO obtiene permisos operativos
        $tecId = DB::table('rol')->where('nombre_rol', 'TECNICO')->value('id_rol');
        $tecPermisos = ['dashboard', 'materiales', 'entradas', 'salidas', 'solicitudes', 'notificaciones', 'clientes'];
        $tecIds = DB::table('permiso')->whereIn('llave', $tecPermisos)->pluck('id_permiso');
        foreach ($tecIds as $pid) {
            DB::table('permiso_rol')->insert([
                'id_permiso' => $pid,
                'id_rol' => $tecId,
            ]);
        }
    }
}
