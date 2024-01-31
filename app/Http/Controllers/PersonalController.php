<?php

namespace App\Http\Controllers;

use App\Models\articulos;
use App\Models\movimientos;
use App\Models\personals;
use App\Models\categorias;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index(){
        return view ('personal.Index');
    }

    public function show($id){

        $empleado = personals::where('id', $id)->first();

        $idCategorias = categorias::where('consumible', false)
        ->get()
        ->toArray();

        $equipos = articulos::whereNotNull('numero_de_serie')
        ->where('nombre_encargado', $empleado->nombre)
        ->get();

        $articulos = articulos::where('numero_de_serie', null)
        ->where('nombre_encargado', $empleado->nombre)
        ->groupBy('nombre_categoria')
        ->selectRaw('nombre_categoria, count(*) as cantidad')
        ->get();

        $materiales = articulos::where('numero_de_serie', null)
        ->where('nombre_encargado', $empleado->nombre)
        ->orderBy('updated_at', 'desc')
        ->take(30)
        ->get();

        $historial = movimientos::where('usuario_origen', $empleado->nombre)
        ->orWhere('usuario_destino', $empleado->nombre)
        ->orderBy('created_at', 'desc')
        ->take(30)
        ->get();

        return view ('personal.show', compact('empleado', 'equipos', 'articulos', 'materiales', 'historial'));
    }
}
