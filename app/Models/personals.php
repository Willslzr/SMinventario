<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personals extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'id_departamento',
        'nombre_departamento',
        'foto'
        ];

        public function departamento()
        {
            return $this->belongsTo(departamentos::class, 'id');
        }

}
