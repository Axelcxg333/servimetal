<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $roles = Rol::with('permisos')->orderBy('nombre_rol')->get();
        $permisos = Permiso::orderBy('grupo')->orderBy('orden')->get()->groupBy('grupo');
        return view('permisos.index', compact('roles', 'permisos'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_rol' => 'required|exists:rol,id_rol',
            'permisos' => 'nullable|array',
            'permisos.*' => 'exists:permiso,id_permiso',
        ]);

        $rol = Rol::findOrFail($request->id_rol);
        $rol->permisos()->sync($request->permisos ?? []);

        return redirect()->route('permisos.index', ['rol' => $request->id_rol])
            ->with('success', 'Permisos actualizados correctamente');
    }
}
