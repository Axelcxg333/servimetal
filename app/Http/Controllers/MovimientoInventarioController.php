<?php

namespace App\Http\Controllers;

use App\Models\MovimientoInventario;
use App\Models\Material;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoInventarioController extends Controller
{
    public function index()
    {
        $movimientos = MovimientoInventario::with('material', 'usuario')->paginate(15);
        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $materiales = Material::where('estado', 'ACTIVO')->get();
        $usuarios = Usuario::all();
        return view('movimientos.create', compact('materiales', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_material' => 'required|exists:material,id_material',
            'id_usuario' => 'required|exists:usuario,id_usuario',
            'tipo_movimiento' => 'required|in:ENTRADA,SALIDA',
            'cantidad' => 'required|numeric|min:0.01',
            'motivo' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $material = Material::findOrFail($request->id_material);
            
            // Validar que hay suficiente stock para salidas
            if ($request->tipo_movimiento === 'SALIDA' && $material->stock_actual < $request->cantidad) {
                throw new \Exception('Stock insuficiente para realizar la salida');
            }

            // Actualizar stock del material
            if ($request->tipo_movimiento === 'ENTRADA') {
                $material->increment('stock_actual', $request->cantidad);
            } else {
                $material->decrement('stock_actual', $request->cantidad);
            }

            // Crear el movimiento
            MovimientoInventario::create($request->all());
        });

        return redirect()->route('movimientos.index')->with('success', 'Movimiento de inventario registrado correctamente');
    }

    public function show(string $id)
    {
        $movimiento = MovimientoInventario::with('material', 'usuario')->findOrFail($id);
        return view('movimientos.show', compact('movimiento'));
    }

    public function edit(string $id)
    {
        $movimiento = MovimientoInventario::findOrFail($id);
        $materiales = Material::where('estado', 'ACTIVO')->get();
        $usuarios = Usuario::all();
        return view('movimientos.edit', compact('movimiento', 'materiales', 'usuarios'));
    }

    public function update(Request $request, string $id)
    {
        $movimiento = MovimientoInventario::findOrFail($id);

        $request->validate([
            'id_material' => 'required|exists:material,id_material',
            'id_usuario' => 'required|exists:usuario,id_usuario',
            'tipo_movimiento' => 'required|in:ENTRADA,SALIDA',
            'cantidad' => 'required|numeric|min:0.01',
            'motivo' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $movimiento) {
            $material = Material::findOrFail($request->id_material);
            $cantidadAnterior = $movimiento->cantidad;
            $tipoAnterior = $movimiento->tipo_movimiento;

            // Revertir el movimiento anterior
            if ($tipoAnterior === 'ENTRADA') {
                $material->decrement('stock_actual', $cantidadAnterior);
            } else {
                $material->increment('stock_actual', $cantidadAnterior);
            }

            // Aplicar nuevo movimiento
            if ($request->tipo_movimiento === 'SALIDA' && $material->stock_actual < $request->cantidad) {
                throw new \Exception('Stock insuficiente para realizar la salida');
            }

            if ($request->tipo_movimiento === 'ENTRADA') {
                $material->increment('stock_actual', $request->cantidad);
            } else {
                $material->decrement('stock_actual', $request->cantidad);
            }

            $movimiento->update($request->all());
        });

        return redirect()->route('movimientos.index')->with('success', 'Movimiento de inventario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $movimiento = MovimientoInventario::findOrFail($id);
        
        DB::transaction(function () use ($movimiento) {
            $material = Material::findOrFail($movimiento->id_material);

            // Revertir el movimiento
            if ($movimiento->tipo_movimiento === 'ENTRADA') {
                $material->decrement('stock_actual', $movimiento->cantidad);
            } else {
                $material->increment('stock_actual', $movimiento->cantidad);
            }

            $movimiento->delete();
        });

        return redirect()->route('movimientos.index')->with('success', 'Movimiento de inventario eliminado correctamente');
    }
}
