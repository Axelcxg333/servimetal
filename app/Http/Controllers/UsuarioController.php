<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->orderByDesc('id_usuario')->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::orderBy('nombre_rol')->get();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres'    => 'required|string|max:100',
            'apellidos'  => 'required|string|max:100',
            'correo'     => 'required|email|max:150|unique:usuario',
            'contrasena' => 'required|string|min:8',
            'id_rol'     => 'required|exists:rol,id_rol',
            'estado'     => 'required|in:ACTIVO,INACTIVO',
        ]);

        $data = $request->all();
        $data['contrasena'] = bcrypt($data['contrasena']);

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    public function show(string $id)
    {
        $usuario = Usuario::with('rol')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::orderBy('nombre_rol')->get();
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombres'    => 'required|string|max:100',
            'apellidos'  => 'required|string|max:100',
            'correo'     => 'required|email|max:150|unique:usuario,correo,' . $id . ',id_usuario',
            'id_rol'     => 'required|exists:rol,id_rol',
            'estado'     => 'required|in:ACTIVO,INACTIVO',
        ]);

        $data = $request->all();
        if ($request->filled('contrasena')) {
            $request->validate(['contrasena' => 'string|min:8']);
            $data['contrasena'] = bcrypt($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
