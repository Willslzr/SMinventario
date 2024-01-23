<?php

namespace App\Livewire\Inventario;

use App\Models\articulos;
use Livewire\Component;
use Livewire\WithPagination;

class index extends Component
{

    use WithPagination;

    public $search = '';
    public $sortField = 'id';
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

        return view('livewire.inventario.index', [
            'articulos' => articulos::query()
            ->orderBy($this->sortField, $this->sortDirection)
            ->orderBy('casa', $this->sortDirection)
            ->paginate($this->perPage)
        ]);
    }
}


