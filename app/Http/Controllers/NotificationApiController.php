<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function checkLowStock()
    {
        $materialesStockBajo = Material::where(function ($query) {
            $query->where('estado', 'INACTIVO')
                ->orWhereRaw('stock_actual < stock_minimo');
        })->get();

        $usuarios = Usuario::where('rol', 'administrador')
            ->orWhere('rol', 'vendedor')
            ->get();

        $creados = 0;
        foreach ($materialesStockBajo as $material) {
            foreach ($usuarios as $usuario) {
                Notificacion::create([
                    'usuario_id' => $usuario->id_usuario,
                    'tipo' => 'stock_bajo',
                    'titulo' => 'Alerta de Stock Bajo',
                    'mensaje' => "El material '{$material->nombre_material}' ({$material->stock_actual} unidades) tiene stock por debajo del mínimo ({$material->stock_minimo} unidades).",
                    'relacionable_type' => Material::class,
                    'relacionable_id' => $material->id_material,
                ]);
                $creados++;
            }
        }

        return response()->json(['creados' => $creados, 'total' => $materialesStockBajo->count()]);
    }
}
