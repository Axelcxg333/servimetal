<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\CategoriaMaterial;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materiales  = Material::with('categoria')->orderByDesc('id_material')->paginate(8);
        $categorias  = CategoriaMaterial::orderBy('nombre_categoria')->get();
        $siguienteId = (Material::max('id_material') ?? 0) + 1;
        return view('materiales.index', compact('materiales', 'categorias', 'siguienteId'));
    }

    public function create()
    {
        $categorias = CategoriaMaterial::all();
        return view('materiales.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_categoria'    => 'required|exists:categoria_material,id_categoria',
            'nombre_material' => 'required|string|max:150',
            'unidad_medida'   => 'required|string|max:50',
            'descripcion'     => 'nullable|string|max:500',
            'stock_minimo'    => 'required|numeric|min:0',
            'stock_actual'    => 'nullable|numeric|min:0',
            'precio_unitario' => 'nullable|numeric|min:0',
            'ubicacion'       => 'nullable|string|max:150',
            'estado'          => 'required|in:ACTIVO,INACTIVO',
        ]);

        $data = $request->all();
        $data['stock_actual']    = $data['stock_actual']    ?? 0;
        $data['precio_unitario'] = $data['precio_unitario'] ?? 0;

        Material::create($data);

        return redirect()->route('materiales.index')->with('success', 'Material registrado correctamente');
    }

    public function show(string $id)
    {
        $material = Material::with('categoria', 'movimientos')->findOrFail($id);
        return view('materiales.show', compact('material'));
    }

    public function edit(string $id)
    {
        $material = Material::findOrFail($id);
        $categorias = CategoriaMaterial::all();
        return view('materiales.edit', compact('material', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'id_categoria'    => 'required|exists:categoria_material,id_categoria',
            'nombre_material' => 'required|string|max:150',
            'unidad_medida'   => 'required|string|max:50',
            'descripcion'     => 'nullable|string|max:500',
            'stock_actual'    => 'required|numeric|min:0',
            'stock_minimo'    => 'required|numeric|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'ubicacion'       => 'nullable|string|max:150',
            'estado'          => 'required|in:ACTIVO,INACTIVO',
        ]);

        $material->update($request->all());

        return redirect()->route('materiales.index')->with('success', 'Material actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materiales.index')->with('success', 'Material eliminado correctamente');
    }
}
