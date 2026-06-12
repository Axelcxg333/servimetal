<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    public function index()
    {
        $unidades = UnidadMedida::orderByDesc('id_unidad')->paginate(10);
        return view('unidades.index', compact('unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_unidad' => 'required|string|max:100|unique:unidad_medida',
            'abreviatura'   => 'nullable|string|max:20',
            'descripcion'   => 'nullable|string|max:500',
            'estado'        => 'required|in:ACTIVO,INACTIVO',
        ]);

        UnidadMedida::create($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad de medida creada correctamente');
    }

    public function edit(string $id)
    {
        $unidad = UnidadMedida::findOrFail($id);
        return view('unidades.edit', compact('unidad'));
    }

    public function update(Request $request, string $id)
    {
        $unidad = UnidadMedida::findOrFail($id);

        $request->validate([
            'nombre_unidad' => 'required|string|max:100|unique:unidad_medida,nombre_unidad,' . $id . ',id_unidad',
            'abreviatura'   => 'nullable|string|max:20',
            'descripcion'   => 'nullable|string|max:500',
            'estado'        => 'required|in:ACTIVO,INACTIVO',
        ]);

        $unidad->update($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad de medida actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $unidad = UnidadMedida::findOrFail($id);
        $unidad->delete();

        return redirect()->route('unidades.index')->with('success', 'Unidad de medida eliminada correctamente');
    }
}
