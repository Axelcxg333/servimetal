<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $cfg = Configuracion::firstOrCreate(
            ['id' => 1],
            [
                'nombre_empresa' => 'SERVIMETAL A&M S.A.C.',
                'ruc'            => '20XXXXXXXXX',
                'telefono'       => '+51 1 2345678',
                'correo'         => 'info@servimetal.com',
                'direccion'      => 'Lima, Perú',
                'stock_min_global' => 10,
            ]
        );
        return view('configuracion.index', compact('cfg'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:200',
            'ruc'            => 'required|string|max:20',
            'telefono'       => 'nullable|string|max:20',
            'correo'         => 'nullable|email|max:150',
            'direccion'      => 'nullable|string|max:200',
            'stock_min_global' => 'required|numeric|min:0',
        ]);

        $cfg = Configuracion::firstOrCreate(['id' => 1]);
        $cfg->update($request->all());

        return redirect()->route('configuracion.index')->with('success', 'Configuración actualizada');
    }
}
