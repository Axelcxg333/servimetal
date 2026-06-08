<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_razon_social' => 'required|string|max:150',
            'ruc_dni' => 'required|string|max:20|unique:cliente',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:200',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre_razon_social' => 'required|string|max:150',
            'ruc_dni' => 'required|string|max:20|unique:cliente,ruc_dni,' . $id . ',id_cliente',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:150',
            'direccion' => 'nullable|string|max:200',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
