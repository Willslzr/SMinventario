<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CodigoQr extends Component
{

    public $articulo;

    public function render()
    {
        return view('livewire.components.codigo-qr');
    }

    public function codigoqr()
    {
        return view('codigoqr');
    }
}
