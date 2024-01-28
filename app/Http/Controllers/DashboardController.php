<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function main(){

        $textoTabla = "Nombre\tEdad\tCiudad
                Juan\t25\tCaracas
                María\t30\tValencia
                Pedro\t40\tMaracaibo";
        return view ('welcome', compact('textoTabla'));
    }
}
