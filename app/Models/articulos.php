<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_categoria',
        'id_ubicacion',
        'id_encargado',
        'numero_de_serie',
        'codigoqr'
    ];

}
