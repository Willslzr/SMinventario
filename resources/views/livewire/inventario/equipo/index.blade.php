<div>
    <div class="d-flex py-2 px-2">
        <div class="">
            <input wire:model="search" wire:change="updateSearch" type="search" placeholder="Buscar" wire:keydown.enter="updateSearch"
            @blur="updateSearch">
        </div>
        <div class="">
            <select wire:model="perPage" wire:change="updatePage" class="align-self-stretch h-100">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="" wire:loading>
            <span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
        </div>
    </div>
<x-table class="table-bordered">
    <x-slot name="thead">
        <tr>
        <th wire:click="sortBy('id')">ID
            <span class="sort-arrow">
                @if ($sortField === 'id')
                    @if ($sortDirection === 'asc')
                        <i class="fas fa-sort-up"></i>
                    @else
                        <i class="fas fa-sort-down"></i>
                    @endif
                @endif
            </span>
        </th>
        <th>N° Serie</th>
        <th>Fecha de registro</th>
        <th>Codigo QR</th>
        <th>Acciones</th>
        </tr>
    </x-slot>
    <x-slot name="tbody">
        @if ($articulos->isEmpty())
            <tr>
                <td colspan="7" class="text-center py-4">No hay registros</td>
            </tr>
        @else
        @foreach ($articulos as $articulo)
            <tr>
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{ $articulo->id }}</h6>
            </td>
            <td class="text-center" style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{ $articulo->numero_de_serie }}</h6>
            </td>
            <td class="text-center" style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{ $articulo->created_at }}</h6>

            </td>
            <td style="text-align: center; vertical-align: middle;">
                {{ QrCode::size(150)
                    ->format('svg')
                    ->merge(public_path('images/santiagologo.svg'), .3, true)
                    ->generate(
                        'ID: ' . $articulo->id . PHP_EOL .
                        'Articulo: ' . $articulo->nombre_categoria . PHP_EOL .
                        'Ubicacion: ' . $articulo->nombre_ubicacion . PHP_EOL .
                        'Asignado a: ' . $articulo->nombre_encargado . PHP_EOL .
                        'Numero de serie: ' . $articulo->numero_de_serie . PHP_EOL .
                        'Asignado el: ' . $articulo->updated_at
                    ) }}
            </td>

            <td style="text-align: center; vertical-align: middle;">
                <div class="btn-group">
                    <a href="{{ route('dashboard.codigoqr', $articulo->id) }}" target="_blank" class="btn btn-info btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Codigo QR">
                        <i class="fas fa-qrcode"></i>
                    </a>
                    <button class="btn btn-warning btn-circle btn-sm" type="button" data-toggle="modal" data-target="#asignar" wire:click="abrirModal({{ $articulo }})">
                        <i class="fas fa-upload"></i>
                    </button>

                    <button class="btn btn-danger btn-circle btn-sm" type="button" data-toggle="modal" data-target="#borrar" wire:click="abrirModal({{ $articulo }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
            </tr>
        @endforeach
        @endif
    </x-slot>
</x-table>

{{ $articulos->links() }}

    <div wire:ignore.self class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="verLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-gradient-light">
                <div class="modal-header">
                    <h4 class="modal-title" id="verLabel"></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="nombre" id="nombre" wire:model="nombre" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-user" name="descripcion" id="descripcion" wire:model="descripcion" style="height: auto" rows="5" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="asignar" tabindex="-1" role="dialog" aria-labelledby="asignarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-gradient-light">
                <div class="modal-header">
                    <h4 class="modal-title" id="asignarLabel">Asignar</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-2 mb-2 mx-0 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="identificador" identificador="identificador" wire:model="identificador" readonly>
                        </div>
                        <div class="col-sm-5 mb-2 mx-0 px-0 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="nombre" id="nombre" wire:model="nombre" readonly>
                        </div>
                        <div class="col-sm-5 mb-2 mx-0 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="numeroSerie" id="numeroSerie" wire:model="numeroSerie" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 mb-1 mb-sm-0">
                            <select class="form-control" name="select" wire:model="select">
                                @if($empleados){
                                    @foreach($empleados as $empleado)
                                    <option value="{{$empleado->id}}">{{$empleado->nombre}}</option>
                                    @endforeach
                                }
                                @else
                                <option value="0">Sin registros</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" type="button" id="asignar-departamento" data-dismiss="modal" wire:click="asignar">Asignar</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="borrarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="borrarLabel">Borrar</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                    <h5 id="borrarLabel">Seguro que quiere borrar este equipo del inventario?</h5>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 mb-2 mx-3 mb-sm-0">
                            <label for="identificador">ID</label>
                            <input type="text" class="form-control form-control-user" name="identificador" identificador="identificador" wire:model="identificador" readonly>
                        </div>
                        <div class="col-sm-4 mb-2 px-0 m-0 mb-sm-0">
                            <label for="Nombre">Equipo</label>
                            <input type="text" class="form-control form-control-user" name="nombre" id="nombre" wire:model="nombre" readonly>
                        </div>
                        <div class="col-sm-4 mb-2 mx-3 mb-sm-0">
                            <label for="numeroSerie">N° de Serie</label>
                            <input type="text" class="form-control form-control-user" name="numeroSerie" id="numeroSerie" wire:model="numeroSerie" readonly>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" id="borrar-equipo" data-dismiss="modal" wire:click="borrar">Borrar</button>
                    </div>
            </div>
        </div>
    </div>

</div>
