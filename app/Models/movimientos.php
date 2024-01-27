<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimientos extends Model
{
    use HasFactory;

    protected $fillable = [
        'departamento_origen',
        'departamento_destino',
        'usuario_origen',
        'usuario_destino',
        'nombre_articulo',
        'id_articulo'
    ];

}
