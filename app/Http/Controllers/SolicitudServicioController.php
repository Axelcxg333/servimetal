<?php

namespace App\Http\Controllers;

use App\Models\SolicitudServicio;
use App\Models\Cliente;
use App\Models\Servicio;
use Illuminate\Http\Request;

class SolicitudServicioController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudServicio::with('cliente', 'servicio', 'usuario')
            ->orderByDesc('id_solicitud')
            ->paginate(10);
        $clientes    = Cliente::orderBy('nombre_razon_social')->get();
        $servicios   = Servicio::where('estado', 'ACTIVO')->orderBy('nombre_servicio')->get();
        $siguienteId = (SolicitudServicio::max('id_solicitud') ?? 0) + 1;
        return view('solicitudes.index', compact('solicitudes', 'clientes', 'servicios', 'siguienteId'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $servicios = Servicio::where('estado', 'ACTIVO')->get();
        return view('solicitudes.create', compact('clientes', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente'      => 'required|exists:cliente,id_cliente',
            'id_servicio'     => 'required|exists:servicio,id_servicio',
            'fecha_solicitud' => 'required|date',
            'fecha_requerida' => 'required|date|after_or_equal:fecha_solicitud',
            'detalle'         => 'required|string',
            'prioridad'       => 'required|in:ALTA,MEDIA,BAJA',
            'estado'          => 'required|in:PENDIENTE,EN_PROCESO,ATENDIDA,FINALIZADO,CANCELADO',
            'observacion'     => 'nullable|string',
        ]);

        $data = $request->all();
        $data['id_usuario'] = session('usuario_id') ?? 1;
        SolicitudServicio::create($data);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud registrada correctamente');
    }

    public function show(string $id)
    {
        $solicitud = SolicitudServicio::with('cliente', 'servicio', 'usuario')->findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit(string $id)
    {
        $solicitud = SolicitudServicio::findOrFail($id);
        $clientes = Cliente::all();
        $servicios = Servicio::where('estado', 'ACTIVO')->get();
        return view('solicitudes.edit', compact('solicitud', 'clientes', 'servicios'));
    }

    public function update(Request $request, string $id)
    {
        $solicitud = SolicitudServicio::findOrFail($id);

        $request->validate([
            'id_cliente'      => 'required|exists:cliente,id_cliente',
            'id_servicio'     => 'required|exists:servicio,id_servicio',
            'fecha_solicitud' => 'required|date',
            'fecha_requerida' => 'required|date|after_or_equal:fecha_solicitud',
            'detalle'         => 'required|string',
            'prioridad'       => 'required|in:ALTA,MEDIA,BAJA',
            'estado'          => 'required|in:PENDIENTE,EN_PROCESO,ATENDIDA,FINALIZADO,CANCELADO',
            'observacion'     => 'nullable|string',
        ]);

        $solicitud->update($request->all());

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente');
    }

    public function destroy(string $id)
    {
        $solicitud = SolicitudServicio::findOrFail($id);
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud de servicio eliminada correctamente');
    }

    public function cambiarEstado(Request $request, string $id)
    {
        $request->validate(['estado' => 'required|in:PENDIENTE,EN_PROCESO,ATENDIDA,FINALIZADO,CANCELADO']);

        $solicitud = SolicitudServicio::findOrFail($id);
        $solicitud->update(['estado' => $request->estado]);

        return redirect()->route('solicitudes.index')->with('success', "Solicitud actualizada a: {$request->estado}");
    }
}
