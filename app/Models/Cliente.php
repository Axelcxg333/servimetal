<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = true;

    protected $fillable = [
        'nombre_razon_social',
        'ruc_dni',
        'telefono',
        'correo',
        'direccion',
    ];

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudServicio::class, 'id_cliente', 'id_cliente');
    }
}
