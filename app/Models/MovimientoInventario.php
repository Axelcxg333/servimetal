<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoInventario extends Model
{
    protected $table = 'movimiento_inventario';
    protected $primaryKey = 'id_movimiento';
    public $timestamps = true;

    protected $fillable = [
        'id_material',
        'id_usuario',
        'tipo_movimiento',
        'cantidad',
        'fecha_movimiento',
        'motivo',
        'observacion',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'fecha_movimiento' => 'datetime',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'id_material', 'id_material');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
