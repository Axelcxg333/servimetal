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
        $total = 0;
        Material::where(function ($query) {
            $query->where('estado', 'INACTIVO')
                ->orWhereRaw('stock_actual < stock_minimo');
        })->chunk(50, function ($materiales) use (&$total) {
            foreach ($materiales as $material) {
                $material->notificarSiStockBajo();
                $total++;
            }
        });

        return response()->json(['creados' => $total]);
    }
}
