<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::orderByDesc('id_rol')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:rol',
            'descripcion' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);

        Rol::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente');
    }

    public function edit(Rol $rol)
    {
        $roles = Rol::orderByDesc('id_rol')->paginate(10);
        return view('roles.index', compact('roles', 'rol'));
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:rol,nombre_rol,' . $rol->id_rol . ',id_rol',
            'descripcion' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:20',
        ]);

        $rol->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(Rol $rol)
    {
        if ($rol->usuarios()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'No se puede eliminar un rol con usuarios asignados');
        }
        $rol->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
    }
}
