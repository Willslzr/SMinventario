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
                <a href="{{route('inventario.create')}}" class="btn btn-sm bg-gradient-primary mb-0 text-white">Nuevo</a>
        </div>
    </div>
<x-table>
    <x-slot name="thead">
        <tr>
        {{-- <th wire:click="sortBy('id')">id
            <span class="sort-arrow">
                @if ($sortField === 'id')
                    @if ($sortDirection === 'asc')
                        <i class="fas fa-sort-up"></i>
                    @else
                        <i class="fas fa-sort-down"></i>
                    @endif
                @endif
            </span>
        </th> --}}
        <th wire:click="sortBy('nombre')">Nombre
            <span class="sort-arrow">
                @if ($sortField === 'nombre')
                    @if ($sortDirection === 'asc')
                        <i class="fas fa-sort-up"></i>
                    @else
                        <i class="fas fa-sort-down"></i>
                    @endif
                @endif
            </span>
        </th>
        <th>Foto</th>
        <th>Cantidad</th>
        <th>Acciones</th>
        </tr>
    </x-slot>
    <x-slot name="tbody">

        @if ($categorias->isEmpty())
            <tr>
                <td colspan="7" class="text-center py-4">No hay registros</td>
            </tr>
        @else
        @foreach ($categorias as $producto)
            <tr>
            {{-- <td>
                <h6 class="mb-0 text-sm">{{ $producto }}</h6>
            </td> --}}
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm" >{{$producto->nombre}}</h6>
            </td>
            <td class="text-center">
                <img src="{{$producto->imagen_referencia}}" alt="{{$producto->nombre}}" class="img-fluid img-thumbnail" width="100">
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{$producto->cantidad_inv}}</h6>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <div class="btn-group">
                    <button class="btn btn-warning btn-circle btn-sm" type="button" data-toggle="modal" data-target="#ver" wire:click="abrirModal({{ $producto }})">
                        <i class="fas fa-eye"></i>
                    </button>

                    <a href="{{ $producto->consumible ? route('inventario.mover', $producto->id) : route('inventario.moverequipo', $producto->id) }}" class="btn btn-sm btn-success btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Asignar">
                        <i class="fas fa-box"></i>
                    </a>
                </div>
            </td>
            </tr >
        @endforeach
        @endif
    </x-slot>
</x-table>

{{ $categorias->links() }}

<div wire:ignore.self class="modal fade" id="ver" tabindex="-1" role="dialog" aria-labelledby="verLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-gradient-light">
            <div class="modal-header">
                <h4 class="modal-title" id="verLabel">ver</h4>
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

</div>
