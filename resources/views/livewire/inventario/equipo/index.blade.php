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
        <div class="ms-auto">
                <a href="#" class="btn btn-sm bg-gradient-primary mb-0 text-white">Nuevo</a>
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
            <td class="text-center">
                <h6 class="mb-0 text-sm">{{ $articulo->numero_de_serie }}</h6>
            </td>
            <td class="text-center">
                <h6 class="mb-0 text-sm">{{ $articulo->created_at }}</h6>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{ asset('$articulo->codigoqr')}}</h6>
            </td>

            <td style="text-align: center; vertical-align: middle;">
                <div class="btn-group">
                    <a href="#" class="btn btn-success btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Ver información">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" target="__blank" class="btn btn-info btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Codigo QR">
                        <i class="fas fa-qrcode"></i>
                    </a>
                    <button class="btn btn-warning btn-circle btn-sm" type="button" data-toggle="modal" data-target="#asignar" wire:click="abrirModal({{ $articulo->id }})">
                        <i class="fas fa-upload"></i>
                    </button>

                    <a href="#" class="btn btn-danger btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="borrar">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
            </tr>
        @endforeach
        @endif
    </x-slot>
</x-table>

{{ $articulos->links() }}

</div>

@section('modal')
<!-- Modal -->
<div class="modal fade" id="asignar" tabindex="-1" role="dialog" aria-labelledby="asignarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarLabel">Asigna el equipo a:</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form action="{{route('inventario.asignarequipo')}}" method="post">
                @csrf
                <div class="modal-body">
                    <select class="form-control" name="empleado" wire:model.live="empleado">
                        @if($empleados){
                            @foreach($empleados as $item)
                            <option value="{{$item['id']}}">{{$item['nombre']}}</option>
                            @endforeach
                        }
                        @else
                        <option value="0">Sin registros</option>
                        @endif
                    </select>
                </div>
                <input type="hidden" name="articulo" wire:model="articulo" value="{{$articulo->id}}">

                <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="submit">Asignar</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
