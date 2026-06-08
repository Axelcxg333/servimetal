<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = true;

    protected $fillable = [
        'ruc',
        'razon_social',
        'contacto',
        'telefono',
        'correo',
        'direccion',
        'estado',
    ];
}
