<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\categorias;

class Create extends Component
{
    public $categorias;
    public $articulo;
    public $numero;
    public $imagenReferencia;
    public $consumible;
    public $cantidad;

    public function mount()
    {
        $this->categorias = categorias::all()->toArray();
        $this->articulo = $this->categorias[0]['nombre'];
        $this->imagenReferencia = $this->categorias[0]['imagen_referencia'];
        $this->consumible = $this->categorias[0]['consumible'];
        $this->cantidad = 1;

    }
    public function updatedarticulo()
    {

        $this->imagenReferencia = categorias::where('id', $this->articulo)->value('imagen_referencia');
        $this->consumible = categorias::where('id', $this->articulo)->value('consumible');
        if(!$this->consumible){
            $this->cantidad = 1;
        }
    }


    public function render()
    {
        return view('livewire.inventario.create');
    }
}
