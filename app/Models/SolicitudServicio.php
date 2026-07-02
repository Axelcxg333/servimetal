<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudServicio extends Model
{
    protected $table = 'solicitud_servicio';
    protected $primaryKey = 'id_solicitud';
    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'id_servicio',
        'id_usuario',
        'fecha_solicitud',
        'fecha_requerida',
        'detalle',
        'prioridad',
        'estado',
        'observacion',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_requerida' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id_servicio');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
