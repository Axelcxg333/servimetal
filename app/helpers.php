<?php

use App\Models\Usuario;
use Illuminate\Support\Facades\Session;

if (!function_exists('tieneAcceso')) {
    function tieneAcceso(string $llave): bool
    {
        $userId = Session::get('usuario_id');
        if (!$userId) return false;

        $usuario = Usuario::with('rol.permisos')->find($userId);
        if (!$usuario || !$usuario->rol) return false;

        return $usuario->rol->permisos->contains('llave', $llave);
    }
}
