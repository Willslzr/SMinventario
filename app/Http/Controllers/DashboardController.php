<?php

namespace App\Http\Controllers;

use App\Models\articulos;
use App\Models\personals;
use App\Models\movimientos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    public function main(){

        return view ('inventario.index');
    }

    public function show($id){
        $articulo = articulos::where('id', $id)->first();

        $codigoqr = QrCode::size(150)
    ->format('svg')
    ->generate(
        'ID: ' . $articulo->id . PHP_EOL .
        'Articulo: ' . $articulo->nombre_categoria . PHP_EOL .
        'Ubicacion: ' . $articulo->nombre_ubicacion . PHP_EOL .
        'Asignado a: ' . $articulo->nombre_encargado . PHP_EOL .
        'Numero de serie: ' . $articulo->numero_de_serie . PHP_EOL .
        'Asignado el: ' . $articulo->updated_at
        );

    $imagenqr = base64_encode($codigoqr);

        // return view('codigoqr', compact('imagenqr'));
        // $pdf = Pdf::loadView('codigoqr', compact('imagenqr'));

        // return $pdf->stream('codigoqr.pdf');
        return response($codigoqr, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="codigoqr.svg"'
        ]);
    }


    public function recibido($empleado, $articulo){
        // dd('recibido');
        $persona = personals::where('id', $empleado)->first();

        $historial = movimientos::where('id_articulo', $articulo)
        ->orderBy('created_at', 'desc')
        ->take(30)
        ->get();

        $usuario = Auth::user()->name;

        $pdf = Pdf::loadView('reportes.recibido', compact('historial', 'usuario'));


        return $pdf->stream('recibido.pdf');
    }
    public function reporteEquipos($empleado){

        $persona = personals::where('id', $empleado)->first();

        $equipos = articulos::whereNotNull('numero_de_serie')
        ->where('id_encargado', $empleado)
        ->get();


        $pdf = Pdf::loadView('reportes.equipos', compact('equipos', 'persona'));


        return $pdf->stream('reporte_equipo.pdf');

        // return view ('reportes.equipos', compact('equipos'));
    }

    public function reportemateriales($empleado){

        $persona = personals::where('id', $empleado)->first();

        $materiales = articulos::where('numero_de_serie', null)
        ->where('id_encargado', $empleado)
        ->orderBy('updated_at', 'desc')
        ->take(30)
        ->get();


        $pdf = Pdf::loadView('reportes.materiales', compact('materiales', 'persona'));


        return $pdf->stream('reporte_materiales.pdf');

    }

    public function reportehistorial($empleado){

        $persona = personals::where('id', $empleado)->first();

        $historial = movimientos::where('usuario_origen', $persona->nombre)
        ->orWhere('usuario_destino', $persona->nombre)
        ->orderBy('created_at', 'desc')
        ->take(30)
        ->get();

        // dd($historial);



        $pdf = Pdf::loadView('reportes.historial', compact('historial', 'persona'));


        return $pdf->stream('reporte_historial.pdf');

    }

    public function reportegeneral(){

        $equipos = articulos::whereNotNull('numero_de_serie')
        ->orderBy('id_encargado', 'asc')
        ->get();


        $pdf = Pdf::loadView('reportes.general', compact('equipos'));

        return $pdf->stream('reporte_equipos.pdf');

    }

    public function reportemovimientos(){

        $historial = movimientos::orderBy('created_at', 'desc')
        ->take(30)
        ->get();

        $pdf = Pdf::loadView('reportes.movimientos', compact('historial'));


        return $pdf->stream('reporte_movimientos.pdf');
    }

    public function reportearticulos(){

        $articulos = articulos::where('numero_de_serie', null)
        ->where('nombre_encargado', 'almacen')
        ->groupBy('nombre_categoria')
        ->selectRaw('nombre_categoria, count(*) as cantidad')
        ->get();

        $pdf = Pdf::loadView('reportes.inventario', compact('articulos'));


        return $pdf->stream('reporte_articulos.pdf');
    }

    public function reportearticulosrecibidos(){

        $articulos = articulos::orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        $articulos = articulos::select('nombre_categoria', 'numero_de_serie')
        ->selectRaw('created_at, COUNT(*) as cantidad')
        ->groupBy('created_at', 'nombre_categoria', 'numero_de_serie')
        ->orderBy('created_at', 'desc')
        ->get();


        $pdf = Pdf::loadView('reportes.articulosrecibidos', compact('articulos'));


        return $pdf->stream('reporte_recibidos.pdf');
    }

    public function reportearticulohistorial($articulo){

        $historial = movimientos::where('id_articulo', $articulo)
        ->orderBy('created_at', 'desc')
        ->get();

        // dd($articulo, $historial);

        $articulos = articulos::select('nombre_categoria', 'numero_de_serie')
        ->selectRaw('created_at, COUNT(*) as cantidad')
        ->groupBy('created_at', 'nombre_categoria', 'numero_de_serie')
        ->orderBy('created_at', 'desc')
        ->get();


        $pdf = Pdf::loadView('reportes.articulohistorial', compact('historial'));

        if ($pdf) {
            // Redirigir a la pantalla anterior
            return redirect()->back()->with('error', 'No se pudo generar el reporte');
        }


        return $pdf->stream('reporte_articulo_historial.pdf');

    }


}
