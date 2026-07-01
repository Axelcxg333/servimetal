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
        'id_unidad',
        'nombre_material',
        'descripcion',
        'stock_actual',
        'stock_minimo',
        'precio_unitario',
        'ubicacion',
        'estado',
    ];

    protected $casts = [
        'stock_actual'    => 'decimal:2',
        'stock_minimo'    => 'decimal:2',
        'precio_unitario' => 'decimal:2',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaMaterial::class, 'id_categoria', 'id_categoria');
    }

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(UnidadMedida::class, 'id_unidad', 'id_unidad');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoInventario::class, 'id_material', 'id_material');
    }

    public function notificarSiStockBajo(): void
    {
        if ($this->estado === 'INACTIVO' || $this->stock_actual < $this->stock_minimo) {
            $usuarios = \App\Models\Usuario::where('rol', 'administrador')
                ->orWhere('rol', 'vendedor')
                ->get();

            foreach ($usuarios as $usuario) {
                \App\Models\Notificacion::where('usuario_id', $usuario->id_usuario)
                    ->where('tipo', 'stock_bajo')
                    ->where('relacionable_id', $this->id_material)
                    ->where('relacionable_type', self::class)
                    ->where('leida', false)
                    ->update(['leida' => true, 'leida_en' => now()]);

                \App\Models\Notificacion::create([
                    'usuario_id' => $usuario->id_usuario,
                    'tipo' => 'stock_bajo',
                    'titulo' => 'Alerta de Stock Bajo',
                    'mensaje' => "El material '{$this->nombre_material}' ({$this->stock_actual} unidades) tiene stock por debajo del mínimo ({$this->stock_minimo} unidades).",
                    'relacionable_type' => self::class,
                    'relacionable_id' => $this->id_material,
                ]);
            }
        }
    }
}
