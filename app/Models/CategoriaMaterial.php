<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaMaterial extends Model
{
    protected $table = 'categoria_material';
    protected $primaryKey = 'id_categoria';
    public $timestamps = true;

    protected $fillable = [
        'nombre_categoria',
        'descripcion',
    ];

    public function materiales(): HasMany
    {
        return $this->hasMany(Material::class, 'id_categoria', 'id_categoria');
    }
}
