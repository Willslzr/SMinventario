<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\categorias;
use Illuminate\Http\Request;
use App\Models\departamentos;
use Illuminate\Support\Facades\Validator;

class ConfiguracionController extends Controller
{
    public function departamentos(){
        return view ('configuracion.departamentos.index');
    }

    public function departamentosstore(request $request){

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:1000'],
        ]);

        $validator->setCustomMessages([
            'nombre' => 'Nombre invalido',
            'descripcion' => 'Descripcion Invalida',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nuevoDepartamento = new departamentos();

            $nuevoDepartamento->nombre = strtoupper($request->input('nombre'));
            $nuevoDepartamento->descripcion = $request->input('descripcion');
            $nuevoDepartamento->save();


        return to_route('configuracion.departamentos')->with('status', 'Producto registrado');

    }

    public function departamentosborrar(request $request){

        dd($request);
        departamentos::where('id', $request->departamento)
        ->delete();

        return to_route('configuracion.departamentos')->with('status', 'Departamento eliminado');
    }

    public function personal(){

        $departamentos = departamentos::all();

        return view ('configuracion.personal.index', compact('departamentos'));
    }

    public function personalstore(request $request){

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'foto' => ['mimes:jpeg,png,jpg,svg'],
        ]);

        $validator->setCustomMessages([
            'nombre' => 'Nombre invalido',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nuevoPersonal = new personals();

        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $carpeta = 'images/perfil/';
            $nombre = time() .  '-' . $foto->getClientOriginalName();
            $carga = $request->file('foto')->move($carpeta, $nombre);
            $nuevoPersonal->foto = $carpeta . $nombre;
        }else{
            $nuevoPersonal->foto = 'images/perfil/default.jpg';
        }

        $nuevoPersonal->nombre = strtoupper($request->input('nombre'));
        $nuevoPersonal->id_departamento = $request->input('departamento');
        $nuevoPersonal->save();

        return to_route('configuracion.personal')->with('status', 'Empleado registrado');

    }

    public function categorias(){
        return view ('configuracion.categorias.index');
    }

    public function categoriasstore(request $request){

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:1000'],
            'foto' => ['mimes:jpeg,png,jpg,svg'],
        ]);

        $validator->setCustomMessages([
            'nombre' => 'Nombre invalido',
            'descripcion.required' => 'Descripcion Invalida',
            'descripcion.string' => 'Descripcion Invalida2',
            'descripcion.max' => 'Descripcion Invalida3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nuevoProducto = new categorias();

        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $carpeta = 'images/articulos/';
            $nombre = time() .  '-' . $foto->getClientOriginalName();
            $carga = $request->file('foto')->move($carpeta, $nombre);
            $nuevoProducto->imagen_referencia = $carpeta . $nombre;
        }else{
            $nuevoProducto->imagen_referencia = 'images/articulos/default.png';
        }

        if($request->input('consumible')){
            $nuevoProducto->consumible = $request->input('consumible');
        }else{
            $nuevoProducto->consumible = 0;
        }

            $nuevoProducto->nombre = strtoupper($request->input('nombre'));
            $nuevoProducto->descripcion = $request->input('descripcion');
            $nuevoProducto->cantidad_inv = 0;
            $nuevoProducto->save();


        return to_route('configuracion.categorias')->with('status', 'Producto registrado');

    }
}
