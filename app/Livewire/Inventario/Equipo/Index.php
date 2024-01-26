<?php

namespace App\Livewire\Inventario\Equipo;

use Livewire\Component;
use App\Models\articulos;
use App\Models\personals;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    protected $queryString = ['search'];
    public $perPage = 10;
    public $producto;
    public $empleados;

    public $articulo;

    public $empleado;

    public $imagenReferencia;

    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->empleados = personals::all()->toArray();
        // dd($this->empleados);
        $this->empleado = $this->empleados[0]['nombre'];
        $this->imagenReferencia = $this->empleados[0]['foto'];
    }

    public function abrirModal($articulo)
    {

        $this->articulo = $articulo; // Asigna el valor del artículo ID a la propiedad $articuloId

    }


    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updateSearch()
{
    $this->resetPage(); // Reinicia la paginación
}

    public function updatePage(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.inventario.equipo.index', [
            'articulos' => articulos::query()
            ->where('id_categoria', $this->producto->id)
            ->where('numero_de_serie', 'like', '%'.strtoupper($this->search).'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id', $this->sortDirection)
            ->paginate($this->perPage),
            'empleados' => $this->empleados
        ]);
    }
}
