<?php

namespace App\Livewire\Inventario\Equipo;

use Livewire\Component;
use App\Models\articulos;
use App\Models\personals;
use App\Models\categorias;
use App\Models\movimientos;
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
    public $articulo;

    public $identificador;
    public $nombre;

    public $numeroSerie;
    public $select;

    public $observacion;

    public $empleados;

    protected $paginationTheme = 'bootstrap';


    public function mount(){

        $this->empleados = personals::all();
        $this->select = $this->empleados->first()->id;

    }
    public function abrirModal($articulo)
    {

        $this->articulo = $articulo;
        $this->identificador = $articulo['id'];
        $this->nombre = $articulo['nombre_categoria'];
        $this->numeroSerie = $articulo['numero_de_serie'];

    }

    public function asignar()
    {

        $empleado = personals::where('id', $this->select)->first();
        $articulo = articulos::where('id', $this->identificador)->first();
        $categoria = categorias::where('id', $this->articulo['id_categoria'])->first();
        $totalRestante = $categoria->cantidad_inv - 1;
        $categoria->update([
            'cantidad_inv' => $totalRestante
        ]);

        $articulo->update([
                    'id_ubicacion' => $empleado->id_departamento,
                    'nombre_ubicacion' => $empleado->nombre_departamento,
                    'id_encargado' => $empleado->id,
                    'nombre_encargado' => $empleado->nombre,
                    'numero_de_serie' => $articulo->numero_de_serie,
                ]);

                $usuarioActual = auth()->user()->name;

        movimientos::create([
            'autorizado_por' => $usuarioActual,
            'observacion' => $this->observacion,
            'departamento_origen' => 'INVENTARIO',
            'departamento_destino' => $empleado->nombre_departamento,
            'usuario_origen' => 'INVENTARIO',
            'usuario_destino' => $empleado->nombre,
            'nombre_articulo' => $categoria->nombre,
            'id_articulo' => $articulo->id,
        ]);


        return redirect()->route('inventario.index');

    }

    public function borrar()
    {
        $categoria = categorias::where('id', $this->articulo['id_categoria'])->first();
        $totalRestante = $categoria->cantidad_inv - 1;
        $categoria->update([
            'cantidad_inv' => $totalRestante
        ]);

        articulos::where('id', $this->identificador)->delete();
        $this->resetPage();
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
            ->where('nombre_encargado', 'almacen')
            ->where('numero_de_serie', 'like', '%'.strtoupper($this->search).'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('id', $this->sortDirection)
            ->paginate($this->perPage),
        ]);
    }
}
