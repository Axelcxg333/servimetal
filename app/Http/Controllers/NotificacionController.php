<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        $userId = session('usuario_id');

        if (!$userId) {
            return response()->json(['notificaciones' => [], 'no_leidas_count' => 0]);
        }

        $query = Notificacion::where('usuario_id', $userId)->latest();

        if ($request->boolean('solo_no_leidas')) {
            $query->where('leida', false);
        }

        $notificaciones = $query->take(20)->get();
        $noLeidasCount = Notificacion::where('usuario_id', $userId)->where('leida', false)->count();

        return response()->json([
            'notificaciones' => $notificaciones,
            'no_leidas_count' => $noLeidasCount,
        ]);
    }

    public function marcarLeida(Notificacion $notificacion)
    {
        $userId = session('usuario_id');

        if ($notificacion->usuario_id !== $userId) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $notificacion->marcarComoLeida();

        return response()->json(['success' => true]);
    }

    public function marcarTodasLeidas(Request $request)
    {
        $userId = session('usuario_id');

        if (!$userId) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        Notificacion::where('usuario_id', $userId)
            ->where('leida', false)
            ->update(['leida' => true, 'leida_en' => now()]);

        return response()->json(['success' => true]);
    }
}
