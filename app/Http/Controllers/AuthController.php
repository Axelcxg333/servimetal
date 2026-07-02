<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::has('usuario_id')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'    => 'required|string',
            'contrasena' => 'required|string',
        ]);

        $usuario = Usuario::with('rol')->where(function ($q) use ($request) {
                $q->where('correo', $request->usuario)
                  ->orWhere('nombres', $request->usuario);
            })
            ->where('estado', 'ACTIVO')
            ->first();

        if (!$usuario) {
            return back()
                ->withInput($request->only('usuario'))
                ->withErrors(['usuario' => 'Credenciales incorrectas']);
        }

        $passwordOk = Hash::check($request->contrasena, $usuario->contrasena)
            || $request->contrasena === $usuario->contrasena;

        if (!$passwordOk) {
            return back()
                ->withInput($request->only('usuario'))
                ->withErrors(['usuario' => 'Credenciales incorrectas']);
        }

        Session::put('usuario_id',   $usuario->id_usuario);
        Session::put('usuario_nombre', trim($usuario->nombres . ' ' . $usuario->apellidos));
        Session::put('usuario_rol',  $usuario->rol->nombre_rol ?? $usuario->rol);

        return redirect()->intended(route('dashboard'));
    }

    public function logout()
    {
        Session::forget(['usuario_id', 'usuario_nombre', 'usuario_rol']);
        Session::flush();
        return redirect()->route('login');
    }
}
