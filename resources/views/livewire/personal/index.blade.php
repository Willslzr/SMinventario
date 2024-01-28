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
                <h6 class="mb-0 text-sm">{{ $item->nombre_departamento ?? 'Sin departamento' }}</h6>
            </td>

            <td style="text-align: center; vertical-align: middle;">
                <div class="btn-group">
                    <a href="{{route('personal.show', $item->id)}}" class="btn btn-success btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Ver información">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="#" class="btn btn-warning btn-circle btn-sm" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
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

{{ $personal->links() }}

</div>
