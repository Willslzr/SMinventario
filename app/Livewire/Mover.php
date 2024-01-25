<?php

namespace App\Livewire;

use App\Models\articulos;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Mover extends ModalComponent
{

    public $newCategoria;
    public $newUbicacion;
    public $newEncargado;

    public $modal;

    public function render()
    {
        return view('livewire.mover');
    }

    public function save()
    {
        $this->emit('mover');
    }
}
