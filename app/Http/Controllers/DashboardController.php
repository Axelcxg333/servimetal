<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\CategoriaMaterial;
use App\Models\MovimientoInventario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stockTotal = Material::sum('stock_actual');
        $entradasCount = MovimientoInventario::where('tipo_movimiento', 'ENTRADA')->sum('cantidad');
        $salidasCount  = MovimientoInventario::where('tipo_movimiento', 'SALIDA')->sum('cantidad');
        $alertasCount  = Material::whereColumn('stock_actual', '<=', 'stock_minimo')->count();

        $ultimosMateriales = Material::with('categoria')
            ->orderByDesc('id_material')
            ->take(5)
            ->get();

        $categoriesData = $this->getCategoriesChartData();
        $movementsData  = $this->getMovementsChartData();

        return view('admin.dashboard', compact(
            'stockTotal',
            'entradasCount',
            'salidasCount',
            'alertasCount',
            'ultimosMateriales',
            'categoriesData',
            'movementsData'
        ));
    }

    private function getCategoriesChartData(): array
    {
        $categories = CategoriaMaterial::with('materiales')->get()->map(function ($cat) {
            return [
                'name'  => $cat->nombre_categoria,
                'count' => $cat->materiales->sum('stock_actual'),
            ];
        });

        return [
            'labels' => $categories->pluck('name')->toArray(),
            'data'   => $categories->pluck('count')->toArray(),
        ];
    }

    private function getMovementsChartData(): array
    {
        $months   = [];
        $entradas = [];
        $salidas  = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->translatedFormat('M');

            $entradas[] = (float) MovimientoInventario::where('tipo_movimiento', 'ENTRADA')
                ->whereMonth('fecha_movimiento', $date->month)
                ->whereYear('fecha_movimiento', $date->year)
                ->sum('cantidad');

            $salidas[] = (float) MovimientoInventario::where('tipo_movimiento', 'SALIDA')
                ->whereMonth('fecha_movimiento', $date->month)
                ->whereYear('fecha_movimiento', $date->year)
                ->sum('cantidad');
        }

        return [
            'labels'   => $months,
            'entradas' => $entradas,
            'salidas'  => $salidas,
        ];
    }
}
