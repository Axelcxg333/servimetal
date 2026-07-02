<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_servicio' => 'required|string|max:150|unique:servicio',
            'descripcion' => 'nullable|string',
            'precio_referencial' => 'nullable|numeric|min:0',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        Servicio::create($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }

    public function show(string $id)
    {
        $servicio = Servicio::with('solicitudes')->findOrFail($id);
        return view('servicios.show', compact('servicio'));
    }

    public function edit(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios', 'servicio'));
    }

    public function update(Request $request, string $id)
    {
        $servicio = Servicio::findOrFail($id);

        $request->validate([
            'nombre_servicio' => 'required|string|max:150|unique:servicio,nombre_servicio,' . $id . ',id_servicio',
            'descripcion' => 'nullable|string',
            'precio_referencial' => 'nullable|numeric|min:0',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente');
    }
}
