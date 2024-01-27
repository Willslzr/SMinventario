<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        ];

        public function personal()
    {
        return $this->hasMany('App\Models\personals', 'id_departamento');
    }
}
