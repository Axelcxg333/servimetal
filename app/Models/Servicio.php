<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = true;

    protected $fillable = [
        'nombre_servicio',
        'descripcion',
        'precio_referencial',
        'estado',
    ];

    protected $casts = [
        'precio_referencial' => 'decimal:2',
    ];

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudServicio::class, 'id_servicio', 'id_servicio');
    }
}
