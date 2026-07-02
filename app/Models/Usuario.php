<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = true;

    protected $fillable = [
        'nombres',
        'apellidos',
        'correo',
        'contrasena',
        'id_rol',
        'estado',
    ];

    protected $hidden = [
        'contrasena',
    ];

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoInventario::class, 'id_usuario', 'id_usuario');
    }

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudServicio::class, 'id_usuario', 'id_usuario');
    }
}
