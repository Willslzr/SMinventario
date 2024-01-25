<?php

namespace App\Http\Controllers;

use App\Models\articulos;
use App\Models\categorias;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index(){
        return view ('inventario.index');
    }

    public function create(){
        return view ('inventario.create');
    }

    public function store(request $request){

        $categoria = categorias::where('id', $request->input('articulo'))->first();

        if($categoria->consumible == false){
            $cantidad = 1;
        }else{
            $cantidad = $request->input('cantidad');
        }

        $categoria->cantidad_inv = $cantidad;
        $categoria->save();

        if($categoria->consumible){
            for($i = 1; $i <= $request->input('cantidad'); $i++){
                articulos::create([
                    'id_categoria' => $categoria->id,
                    'id_ubicacion' => 1,
                    'id_encargado' => 1,
                ]);
            }
        }else{
            articulos::create([
                'id_categoria' => $categoria->id,
                'id_ubicacion' => 1,
                'id_encargado' => 1,
                'numero_de_serie' => $request->input('numeroserie'),
                // 'codigoqr' => $codigo,
            ]);
        }



        return redirect()->route('inventario.create');
    }
}
