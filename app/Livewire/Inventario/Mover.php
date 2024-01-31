<?php

namespace App\Livewire\Inventario;

use Livewire\Component;
use App\Models\personals;
use App\Models\categorias;

class Mover extends Component
{
    public $producto;

    public $imagenproducto;
    public $imagenReferencia;
    public $personal;
    public $empleado;
    public $cantidad;
    public $restante;
    public $total;

    public function rules()
    {
        return [
            'cantidad' => 'required|numeric|min:1|max:' . $this->total,
        ];
    }

    public function mount(){
        $this->personal = personals::all()->toArray();
        $this->imagenReferencia = $this->personal[0]['foto'];
        $this->empleado = $this->personal[0]['nombre'];
        $this->cantidad = 1;
        $this->total = categorias::where('id', $this->producto->id)->value('cantidad_inv');
        $this->restante = $this->total - $this->cantidad;
        $this->imagenproducto = $this->producto->imagen_referencia;
    }

    public function updatedCantidad()
    {
        $this->restante = $this->total - $this->cantidad;
    }
    public function updatedempleado()
    {
        $this->imagenReferencia = personals::where('id', $this->empleado)->value('foto');
    }

    public function render()
    {
        return view('livewire.inventario.mover');
    }
}
