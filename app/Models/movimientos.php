<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimientos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dep_origen',
        'id_dep_destino',
        'id_usuario_origen',
        'id_usuario_destino',
        'id_articulo'
    ];

}
