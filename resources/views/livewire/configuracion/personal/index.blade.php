<div>
    <div class="d-flex py-2 px-2">
        <div class="">
            <input wire:model="search" wire:change="updateSearch" type="search" placeholder="Buscar" wire:keydown.enter="updateSearch"
            @blur="updateSearch">
        </div>
        <div class="">
            <select wire:model="perPage" wire:change="updatePage" class="align-self-stretch h-100">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="" wire:loading>
            <span class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
        </div>
    </div>
<x-table class="table-bordered">
    <x-slot name="thead">
        <tr>
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
        <th>Departamento</th>
        <th>Acciones</th>
        </tr>
    </x-slot>
    <x-slot name="tbody">
        @if ($personal->isEmpty())
            <tr>
                <td colspan="7" class="text-center py-4">No hay registros</td>
            </tr>
        @else
        @foreach ($personal as $item)
            <tr>
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">{{ $item->nombre }}</h6>
            </td>
            <td class="text-center">
                <img src="{{asset($item->foto)}}" alt="{{$item->nombre}}" class="img-fluid img-thumbnail" width="100">
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h6 class="mb-0 text-sm">
                    {{ $item->nombre_departamento ?? '(Sin departamento)' }}
                </h6>
            </td>

            <td style="text-align: center; vertical-align: middle;">
                <div class="btn-group">
                    <button class="btn btn-warning btn-circle btn-sm" type="button" data-toggle="modal" data-target="#editar" wire:click="abrirModal({{ $item }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    {{-- <button class="btn btn-danger btn-circle btn-sm" type="button" data-toggle="modal" data-target="#borrar" wire:click="abrirModal({{ $item }})">
                        <i class="fas fa-trash"></i>
                    </button> --}}
                </div>
            </td>
            </tr>
        @endforeach
        @endif
    </x-slot>
</x-table>

{{ $personal->links() }}

    <div wire:ignore.self class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="borrarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="borrarLabel">Borrar</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                    <h5 id="borrarLabel">Seguro que quiere borrar al empleado?</h5>
                        <input type="text" class="form-control-plaintext w-100 font-weight-bold text-truncate" wire:model="nombre" readonly>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" id="borrar-departamento" data-dismiss="modal" wire:click="borrar">Borrar</button>
                    </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-gradient-light">
                <div class="modal-header">
                    <h4 class="modal-title" id="editarLabel">Editar</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="nombre" id="nombre" wire:model="nombre">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 mb-1 mb-sm-0">
                                <select class="form-control" name="select" wire:model="select">
                                    @if($departamentos){
                                        @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                        @endforeach
                                    }
                                    @else
                                    <option value="0">Sin registros</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group" style="border: none;">
                            <label for="foto" class="ml-3">Nueva de perfil</label>
                            <div class="col-sm-12 mb-sm-0">
                            <input type="file" class="form-control form-control-user" name="fotonueva" id="fotonueva" wire:modal="fotonueva">
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="button" id="editar-departamento" data-dismiss="modal" wire:click="editar">Editar</button>
                    </div>
            </div>
        </div>
    </div>

</div>
