<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    public $timestamps = true;

    protected $fillable = [
        'llave',
        'nombre',
        'grupo',
        'orden',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'permiso_rol', 'id_permiso', 'id_rol', 'id_permiso', 'id_rol')
            ->withTimestamps();
    }
}
