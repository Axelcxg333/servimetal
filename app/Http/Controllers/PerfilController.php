<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    public function index()
    {
        $id    = Session::get('usuario_id');
        $user  = $id ? Usuario::find($id) : null;

        if (!$user) {
            return redirect()->route('login');
        }

        return view('perfil.index', compact('user'));
    }

    public function update(Request $request)
    {
        $id   = Session::get('usuario_id');
        $user = $id ? Usuario::find($id) : null;

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'nombres'    => 'required|string|max:100',
            'apellidos'  => 'required|string|max:100',
            'correo'     => 'required|email|max:150|unique:usuario,correo,' . $user->id_usuario . ',id_usuario',
            'contrasena_actual'   => 'nullable|required_with:contrasena_nueva|string',
            'contrasena_nueva'    => 'nullable|required_with:contrasena_actual|string|min:8|confirmed',
        ]);

        $user->nombres   = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->correo    = $request->correo;

        if ($request->filled('contrasena_nueva')) {
            $ok = Hash::check($request->contrasena_actual, $user->contrasena)
                || $request->contrasena_actual === $user->contrasena;

            if (!$ok) {
                return back()->withErrors(['contrasena_actual' => 'La contraseña actual no es correcta'])->withInput();
            }
            $user->contrasena = bcrypt($request->contrasena_nueva);
        }

        $user->save();
        Session::put('usuario_nombre', trim($user->nombres . ' ' . $user->apellidos));

        return back()->with('success', 'Perfil actualizado correctamente');
    }
}
