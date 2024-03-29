<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'nombre_categoria',
        'id_ubicacion',
        'nombre_ubicacion',
        'id_encargado',
        'nombre_encargado',
        'numero_de_serie',
        'id_articulo',
        'codigoqr'
    ];

    public function categoria()
    {
        return $this->belongsTo(categorias::class, 'id_categoria');
    }

    public function movimientos()
    {
        return $this->hasMany(movimientos::class, 'id_articulo');
    }

}
