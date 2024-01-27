<?php

namespace App\Livewire\Configuracion\Departamentos;

use App\Models\departamentos;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'departamentos';
    public $sortDirection = 'asc';
    protected $queryString = ['search'];
    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';
    public $departamento;
    public $nombre;

    public $text;

// En el componente Livewire
    protected $listeners = ['borrarDepartamento']; // Nombre correcto del evento

    public function borrarDepartamento($id)
    {
        dd($id, 'se ejecuto borrar departamento');
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

    public function abrirModal($departamento)
    {
        $this->departamento = $departamento['id'];
        $this->nombre = $departamento['nombre'];
        $this->text = $departamento['descripcion'];

    }

    public function borrar()
    {
        departamentos::where('id', $this->departamento)->delete();
        $this->resetPage();
    }

    public function editar()
    {
        departamentos::where('id', $this->departamento)
        ->update([
            'nombre' => strtoupper($this->nombre),
            'descripcion' => $this->text
        ]);

        $this->resetPage();
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

        return view('livewire.configuracion.departamentos.index', [
            'departamentos' => departamentos::query()
            ->where('nombre', 'like', '%'.strtoupper($this->search).'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('nombre', $this->sortDirection)
            ->paginate($this->perPage),
        ]);
    }
}
