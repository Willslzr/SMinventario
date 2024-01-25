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
        <th wire:click="sortBy('id')">id
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
        @if ($articulos->isEmpty())
            <tr>
                <td colspan="7" class="text-center py-4">No hay registros</td>
            </tr>
        @else
        @foreach ($articulos as $articulo)
            <tr>
            <td>
                <h6 class="mb-0 text-sm">{{ $articulo }}</h6>
            </td>
            <td>
                <h6 class="mb-0 text-sm">#</h6>
            </td>
            <td>
                <h6 class="mb-0 text-sm">#</h6>
            </td>
            <td>
                <h6 class="mb-0 text-sm">#</h6>
            </td>
            <td>
                <div class="btn-group">
                    <a href="#" class="btn btn-sm btn-info" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Ver información">
                        <i class="material-icons text-sm">visibility</i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary" style="margin-bottom: 0" data-toggle="tooltip" data-original-title="Editar">
                        <i class="material-icons text-sm">edit</i>
                    </a>
                </div>
            </td>
            </tr >
        @endforeach
        @endif
    </x-slot>
</x-table>

{{ $articulos->links() }}

</div>
