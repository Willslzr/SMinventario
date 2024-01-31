<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimientos extends Model
{
    use HasFactory;

    protected $fillable = [
        'autorizado_por',
        'observacion',
        'departamento_origen',
        'departamento_destino',
        'usuario_origen',
        'usuario_destino',
        'nombre_articulo',
        'id_articulo'
    ];

    public function articulo()
    {
        return $this->belongsTo(articulos::class, 'id_articulo');
    }
}
