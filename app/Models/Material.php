<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $table = 'material';
    protected $primaryKey = 'id_material';
    public $timestamps = true;

    protected $fillable = [
        'id_categoria',
        'nombre_material',
        'unidad_medida',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'precio_unitario',
        'ubicacion',
        'estado',
    ];

    protected $casts = [
        'stock_actual' => 'decimal:2',
        'stock_minimo' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaMaterial::class, 'id_categoria', 'id_categoria');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoInventario::class, 'id_material', 'id_material');
    }
}
