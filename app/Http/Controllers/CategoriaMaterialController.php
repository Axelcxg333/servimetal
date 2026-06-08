<?php

namespace App\Http\Controllers;

use App\Models\CategoriaMaterial;
use Illuminate\Http\Request;

class CategoriaMaterialController extends Controller
{
    public function index()
    {
        $categorias = CategoriaMaterial::with('materiales')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_material',
            'descripcion' => 'nullable|string',
        ]);

        CategoriaMaterial::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    public function show(string $id)
    {
        $categoria = CategoriaMaterial::with('materiales')->findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    public function edit(string $id)
    {
        $categoria = CategoriaMaterial::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, string $id)
    {
        $categoria = CategoriaMaterial::findOrFail($id);

        $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria_material,nombre_categoria,' . $id . ',id_categoria',
            'descripcion' => 'nullable|string',
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
