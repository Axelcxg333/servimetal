<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MovimientoInventario;
use App\Models\CategoriaMaterial;

class ReporteController extends Controller
{
    public function index()
    {
        $stockPorCategoria = CategoriaMaterial::with('materiales')
            ->get()
            ->map(fn ($c) => [
                'categoria' => $c->nombre_categoria,
                'total'     => (float) $c->materiales->sum('stock_actual'),
                'items'     => $c->materiales->count(),
            ]);

        $movimientos = MovimientoInventario::orderByDesc('fecha_movimiento')->limit(50)->get();

        $alertas = Material::whereColumn('stock_actual', '<=', 'stock_minimo')
            ->with('categoria')
            ->get();

        return view('reportes.index', compact('stockPorCategoria', 'movimientos', 'alertas'));
    }
}
