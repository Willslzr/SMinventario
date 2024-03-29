@extends('Backend.layouts.app')
@section('main-content')

<section>
    <x-card>
        <x-slot name="header">
                <h4 class="text-white text-capitalize ps-3">Empleado</h4>
        </x-slot>
        <x-slot name="body">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-12 row">
                        <div class="text-center col-sm-6">
                            <img src="{{asset($empleado->foto)}}" alt="{{$empleado->nombre}}" class="img-fluid img-thumbnail" width="120">
                        </div>
                        <div class="text-center col-sm-6">
                            <div class="text-center col-sm-6">
                                <label for="Nombre"><h3>{{$empleado->nombre}}</h3></label>
                            </div>
                            <div class="text-center col-sm-6">
                                <label for="Departamento">{{$empleado->nombre_departamento}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <ul class="nav nav-pills ml-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-equipos-tab" data-toggle="pill" href="#pills-equipos" role="tab" aria-controls="pills-equipos" aria-selected="true">Equipos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-utiles-tab" data-toggle="pill" href="#pills-utiles" role="tab" aria-controls="pills-utiles" aria-selected="false">Materiales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-historial-tab" data-toggle="pill" href="#pills-historial" role="tab" aria-controls="pills-historial" aria-selected="false">Historial</a>
                        </li>
                    </ul>
                </div>
                <hr>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-equipos" role="tabpanel" aria-labelledby="pills-equipos-tab">
                            <div class="ms-auto">
                                <a href="{{ route('dashboard.reporte.equipos', $empleado->id) }}" target="_blank" class="btn btn-sm bg-gradient-primary mb-0 text-white"><i
                                    class="fas fa-download fa-sm text-white-50"></i>Generar Reporte de equipos</a>
                            </div>
                            <table class="table table-striped table-hover align-items-center mb-2 rounded table-sm">
                            <thead class="bg-gradient-primary text-center text-uppercase text-white font-weight-bolder">
                                <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>N° Serial</th>
                                <th>Recibido</th>
                                <th>Codigo QR</th>
                                <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach ($equipos as $item)

                                <tr class="text-center">
                                    <td style="text-align: center; vertical-align: middle;">{{$item->id}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$item->nombre_categoria}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$item->numero_de_serie}}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{$item->updated_at}}</td>
                                    <td>
                                        {{-- @dd($item) --}}
                                        {{ QrCode::size(150)
                                            ->format('svg')
                                            ->merge(public_path('images/santiagologo.svg'), .3, true)
                                            // ->format('png')
                                            // ->merge('/public/images/santiagologo.png')
                                            // ->errorCorrection('M')
                                            ->generate(
                                                'ID: ' . $item->id . PHP_EOL .
                                                'Articulo: ' . $item->nombre_categoria . PHP_EOL .
                                                'Ubicacion: ' . $item->nombre_ubicacion . PHP_EOL .
                                                'Asignado a: ' . $item->nombre_encargado . PHP_EOL .
                                                'Numero de serie: ' . $item->numero_de_serie . PHP_EOL .
                                                'Asignado el: ' . $item->updated_at
                                            ) }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div class="btn-group">
                                            <a href="{{ route('recibido', [$empleado->id, $item->id]) }}" target="_blank" class="btn btn-primary mx-1 btn-sm" type="button">
                                                <i class="fas fa-file-upload"></i>
                                            </a>
                                            <a href="{{ route('dashboard.codigoqr', $item->id) }}" target="_blank" class="btn btn-success mx-1 btn-sm" type="button">
                                                <i class="fas fa-qrcode"></i>
                                            </a>
                                        @livewire('components.td', ['equipo' => $item, 'empleado' => $empleado, 'nombre' => $item->nombre_categoria])
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-utiles" role="tabpanel" aria-labelledby="pills-utiles-tab">
                            <div class="ms-auto">
                                <a href="{{ route('dashboard.reporte.materiales', $empleado->id)}}" target="_blank" class="btn btn-sm bg-gradient-primary mb-0 text-white"><i
                                    class="fas fa-download fa-sm text-white-50"></i>Generar Reporte de materiales</a>
                            </div>
                            <table class="table table-striped table-hover align-items-center mb-2 rounded table-sm">
                            <thead class="bg-gradient-primary text-center text-uppercase text-white font-weight-bolder">
                                <tr>
                                <th>Material</th>
                                <th>Recibido</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach($materiales as $articulo)
                                <tr class="text-center">
                                <td>{{$articulo->categoria->nombre}}</td>
                                <td>{{$articulo->updated_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-historial" role="tabpanel" aria-labelledby="pills-historial-tab">
                            <div class="ms-auto">
                                <a href="{{ route('dashboard.reporte.historial', $empleado->id) }}" target="_blank" class="btn btn-sm bg-gradient-primary mb-0 text-white"><i
                                    class="fas fa-download fa-sm text-white-50"></i>Generar Reporte de historial</a>
                            </div>
                            <table class="table table-striped table-hover align-items-center mb-2 rounded table-sm">
                            <thead class="bg-gradient-primary text-center text-uppercase text-white font-weight-bolder">
                                <tr>
                                <th>ID</th>
                                <th>Equipo/Material</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="bg-light">
                                @foreach($historial as $ficha)
                                <tr class="text-center">
                                <td>{{$ficha->id_articulo}}</td>
                                <td>{{$ficha->nombre_articulo}}</td>
                                <td>{{$ficha->usuario_origen}}</td>
                                <td>{{$ficha->usuario_destino}}</td>
                                <td>{{$ficha->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>

            </div>
        </x-slot>
    </x-card>

</section>

@endsection
@push('custom-scripts')
@endpush
