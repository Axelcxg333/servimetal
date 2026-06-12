<?php

namespace App\Http\Controllers;

use App\Models\CategoriaMaterial;
use Illuminate\Http\Request;

class CategoriaMaterialController extends Controller
{
    public function index()
    {
        $categorias = CategoriaMaterial::withCount('materiales')
            ->orderByDesc('id_categoria')
            ->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_material',
            'descripcion'      => 'nullable|string|max:500',
        ]);

        CategoriaMaterial::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    public function edit(string $id)
    {
        $categoria  = CategoriaMaterial::withCount('materiales')->findOrFail($id);
        $categorias = CategoriaMaterial::withCount('materiales')
            ->orderByDesc('id_categoria')
            ->paginate(10);
        return view('categorias.index', compact('categoria', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $categoria = CategoriaMaterial::findOrFail($id);

        $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_material,nombre_categoria,' . $id . ',id_categoria',
            'descripcion'      => 'nullable|string|max:500',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $categoria = CategoriaMaterial::findOrFail($id);

        if ($categoria->materiales()->exists()) {
            return redirect()->route('categorias.index')->with('error', 'No puede eliminar una categoría que tiene materiales asociados');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }
}
