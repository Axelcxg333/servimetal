<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas     = MovimientoInventario::with('material', 'usuario')
            ->where('tipo_movimiento', 'SALIDA')
            ->orderByDesc('fecha_movimiento')
            ->paginate(10);
        $materiales  = Material::where('estado', 'ACTIVO')->orderBy('nombre_material')->get();
        $usuarios    = Usuario::where('estado', 'ACTIVO')->get();
        return view('salidas.index', compact('salidas', 'materiales', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_material' => 'required|exists:material,id_material',
            'id_usuario'  => 'required|exists:usuario,id_usuario',
            'cantidad'    => 'required|numeric|min:0.01',
            'fecha_movimiento' => 'required|date',
            'motivo'      => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
        ]);

        $data = $request->all();
        $material = Material::findOrFail($data['id_material']);

        if ($data['cantidad'] > $material->stock_actual) {
            return redirect()->back()->withInput()->withErrors([
                'cantidad' => "La cantidad no puede superar el stock disponible ({$material->stock_actual})."
            ]);
        }

        $data['tipo_movimiento'] = 'SALIDA';
        MovimientoInventario::create($data);

        $material->stock_actual -= $data['cantidad'];
        $material->save();

        $material->notificarSiStockBajo();

        return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente');
    }
}
