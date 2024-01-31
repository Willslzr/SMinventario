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
                    'nombre_categoria' => $categoria->nombre,
                    'id_ubicacion' => 1,
                    'nombre_ubicacion' => 'INVENTARIO',
                    'id_encargado' => 1,
                    'nombre_encargado' => 'almacen',
                ]);
            }
        }else{
            articulos::create([
                'id_categoria' => $categoria->id,
                'nombre_categoria' => $categoria->nombre,
                'id_ubicacion' => 1,
                'nombre_ubicacion' => 'INVENTARIO',
                'id_encargado' => 1,
                'nombre_encargado' => 'almacen',
                'numero_de_serie' => $request->input('numeroserie') ?? 1000,
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
        $cantidadArticulosMov = $request->input('cantidad');
        $productoid = $request->input('producto');
        $totalRestante = $request->input('total');
        $empleado = personals::where('id', $empleadoid)
        ->first();

        $nuevoTotal = $totalRestante - $cantidadArticulosMov;


        categorias::where('id', $request->input('producto'))
        ->update(['cantidad_inv' => $nuevoTotal]);


        for($i=1; $i <= $cantidadArticulosMov; $i++){
            $articulo = articulos::where('id_categoria', $productoid)
            ->where('nombre_encargado', 'almacen')
            ->first();

            $usuarioActual = auth()->user()->name;

            movimientos::create([
                'autorizado_por' => $usuarioActual,
                'departamento_origen' => 'INVENTARIO',
                'departamento_destino' => $empleado->nombre_departamento,
                'usuario_origen' => 'INVENTARIO',
                'usuario_destino' => $empleado->nombre,
                'nombre_articulo' => $articulo->nombre_categoria,
                'id_articulo' => $articulo->id,
            ]);

            $articulo->update([
                'id_ubicacion' => $empleado->id_departamento,
                'nombre_ubicacion' => $empleado->nombre_departamento,
                'id_encargado' => $empleado->id,
                'nombre_encargado' => $empleado->nombre,
            ]);

        }

        return redirect()->route('inventario.index');
    }

    public function moverequipo($id){

        $producto = categorias::where('id', $id)->first();

        return view ('inventario.equipo.Index', compact('producto'));
    }

}
