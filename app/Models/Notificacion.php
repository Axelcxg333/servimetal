<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    protected $primaryKey = 'id_notificacion';
    public $timestamps = true;

    protected $fillable = [
        'usuario_id',
        'tipo',
        'titulo',
        'mensaje',
        'relacionable_id',
        'relacionable_type',
        'leida',
        'leida_en',
    ];

    protected $casts = [
        'leida' => 'boolean',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    public function relacionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeNoLeidas($query)
    {
        return $query->where('leida', false);
    }

    public function scopeTipo($query, string $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    public function marcarComoLeida(): void
    {
        $this->update(['leida' => true, 'leida_en' => now()]);
    }
}
