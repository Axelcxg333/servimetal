<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas     = MovimientoInventario::with('material', 'usuario')
            ->where('tipo_movimiento', 'ENTRADA')
            ->orderByDesc('fecha_movimiento')
            ->paginate(10);
        $materiales   = Material::where('estado', 'ACTIVO')->orderBy('nombre_material')->get();
        $usuarios     = Usuario::where('estado', 'ACTIVO')->get();
        return view('entradas.index', compact('entradas', 'materiales', 'usuarios'));
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
        $data['tipo_movimiento'] = 'ENTRADA';
        MovimientoInventario::create($data);

        $material = Material::find($data['id_material']);
        $material->stock_actual = $material->stock_actual + $data['cantidad'];
        $material->save();

        return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente');
    }
}
