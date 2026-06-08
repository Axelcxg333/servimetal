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
        $data['tipo_movimiento'] = 'SALIDA';
        MovimientoInventario::create($data);

        $material = Material::find($data['id_material']);
        $material->stock_actual = max(0, $material->stock_actual - $data['cantidad']);
        $material->save();

        return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente');
    }
}
