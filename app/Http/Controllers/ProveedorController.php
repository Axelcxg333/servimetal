<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('razon_social')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruc'          => 'required|string|max:20|unique:proveedor,ruc',
            'razon_social' => 'required|string|max:200',
            'contacto'     => 'nullable|string|max:150',
            'telefono'     => 'nullable|string|max:20',
            'correo'       => 'nullable|email|max:150',
            'direccion'    => 'nullable|string|max:200',
            'estado'       => 'required|in:ACTIVO,INACTIVO',
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado');
    }

    public function update(Request $request, string $id)
    {
        $p = Proveedor::findOrFail($id);
        $request->validate([
            'ruc'          => 'required|string|max:20|unique:proveedor,ruc,' . $p->id_proveedor . ',id_proveedor',
            'razon_social' => 'required|string|max:200',
            'contacto'     => 'nullable|string|max:150',
            'telefono'     => 'nullable|string|max:20',
            'correo'       => 'nullable|email|max:150',
            'direccion'    => 'nullable|string|max:200',
            'estado'       => 'required|in:ACTIVO,INACTIVO',
        ]);
        $p->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado');
    }

    public function destroy(string $id)
    {
        Proveedor::findOrFail($id)->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado');
    }
}
