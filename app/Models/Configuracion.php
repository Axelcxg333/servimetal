<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre_empresa',
        'ruc',
        'telefono',
        'correo',
        'direccion',
        'stock_min_global',
    ];
}
