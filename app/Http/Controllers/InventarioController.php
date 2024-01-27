<?php

namespace App\Http\Controllers;

use App\Models\articulos;
use App\Models\personals;
use App\Models\categorias;
use App\Models\movimientos;
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

        $categoria->cantidad_inv = $categoria->cantidad_inv + $cantidad;
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


    public function mover($id){

        $producto = categorias::where('id', $id)->first();

        return view ('inventario.mover', compact('producto'));
    }

    public function savemove(request $request){


        $empleadoid = $request->input('empleado');
        $cantidadmov = $request->input('cantidad');
        $productoid = $request->input('producto');
        $total = $request->input('total');
        $ubicacion = personals::where('id', $empleadoid)
        ->first();

        $nuevoTotal = $total - $cantidadmov;

        categorias::where('id', $request->input('producto'))
        ->update(['cantidad_inv' => $nuevoTotal]);

        for($i=1; $i <= $cantidadmov; $i++){
            $articulo = articulos::where('id_categoria', $productoid)
            ->where('id_ubicacion', 1)
            ->first();

            movimientos::create([
                'id_dep_origen' => 1,
                'id_dep_destino' => $ubicacion->departamento->id,
                'id_usuario_origen' => 1,
                'id_usuario_destino' => $empleadoid,
                'id_articulo' => $articulo->id,
            ]);

            $articulo->update([
                'id_ubicacion' => $ubicacion->departamento->id,
                'id_encargado' => $empleadoid,
            ]);

        }
        //este proyecto lo hice como en 3 semanas, no me juzguen xd

        return redirect()->route('inventario.index');
    }

    public function moverequipo($id){

        $producto = categorias::where('id', $id)->first();

        return view ('inventario.equipo.Index', compact('producto'));
    }

    public function asignarequipo(request $request){

        dd('pendiente arreglar no esta guardando bien');
        $empleado = personals::where('id', $request->input('empleado'))->first();
        $articulo = articulos::where('id', $request->input('articulo'))->first();
        $categoria = categorias::where('id', $articulo->categoria->id)->first();
        $totalRestante = $categoria->cantidad_inv - 1;

        $categoria->update([
            'cantidad_inv' => $totalRestante
        ]);

        $articulo->update([
            'id_categoria' => $categoria->id,
            'id_ubicacion' => $empleado->departamento->id,
            'id_encargado' => $empleado->id,
            'numero_de_serie' => $articulo->numero_de_serie,
            'codigoqr' => $articulo->codigoqr,
        ]);

        movimientos::create([
            'id_dep_origen' => 1,
            'id_dep_destino' => $empleado->departamento->id,
            'id_usuario_origen' => 1,
            'id_usuario_destino' => $empleado->id,
            'id_articulo' => $articulo->id,
        ]);

        return redirect()->route('inventario.index');
    }
}
