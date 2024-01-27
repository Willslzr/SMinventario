<?php

namespace App\Livewire\Configuracion\Personal;

use Livewire\Component;
use App\Models\personals;
use Livewire\WithPagination;
use App\Models\departamentos;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    protected $queryString = ['search'];
    public $perPage = 5;

    public $departamentos;

    public $select;

    public $empleado;

    public $nombre;

    public $foto;

    public $fotonueva;

    protected $paginationTheme = 'bootstrap';


    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function mount(){
        $this->departamentos = departamentos::all();
    }
    public function abrirModal($item)
    {
        $this->empleado = $item;
        $this->nombre = $item['nombre'];
        $this->foto = $item['foto'];
    }

    public function borrar()
    {
        personals::where('id', $this->empleado['id'])->delete();
        $this->resetPage();
    }

    public function editar()
    {

        // if($this->fotonueva->hasFile('foto')){
        //     $foto = $this->fotonueva->file('foto');
        //     $carpeta = 'images/perfil/';
        //     $nombre = time() .  '-' . $foto->getClientOriginalName();
        //     $carga = $this->fotonueva->file('foto')->move($carpeta, $nombre);
        //     $foto = $carpeta . $nombre;
        // }else{
        //     //ya veremos si se acomoda esto
        // }


        $nombreDepartamento = departamentos::where('id', $this->select)
        ->value('nombre');

        personals::where('id', $this->empleado['id'])
        ->update([
            'nombre' => strtoupper($this->nombre),
            'id_departamento' => $this->empleado['id'],
            'nombre_departamento' => $nombreDepartamento
        ]);
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

        return view('livewire.configuracion.personal.index', [
            'personal' => personals::query()
            ->where('nombre', 'like', '%'.strtoupper($this->search).'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('nombre', $this->sortDirection)
            ->paginate($this->perPage)
        ]);
    }
}
