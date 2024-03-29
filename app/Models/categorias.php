<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    use HasFactory;

    protected $fillable = [
    'nombre',
    'descripcion',
    'consumible',
    'imagen_referencia',
    'cantidad_inv'
    ];

    public function articulos()
{
    return $this->hasMany('App\Models\articulos', 'id_categoria');
}
}
