<?php

namespace App\Livewire\Configuracion\Categorias;

use App\Models\categorias;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'nombre';
    public $sortDirection = 'asc';
    protected $queryString = ['search'];
    public $perPage = 10;
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

    public function updateSearch()
{
    $this->resetPage(); // Reinicia la paginación
}

    public function updatePage(){
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.configuracion.categorias.index', [
            'categorias' => categorias::query()
            ->where('nombre', 'like', '%'.strtoupper($this->search).'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('nombre', $this->sortDirection)
            ->paginate($this->perPage)
        ]);
    }
}
