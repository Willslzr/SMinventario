<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\articulos;
use App\Models\categorias;
use App\Models\movimientos;

class Td extends Component
{

    public $equipo;

    public $nombre;

    public $empleado;
    public function regresar()
    {
        articulos::where('id', $this->equipo->id)
        ->update([
            'id_ubicacion' => 1,
            'nombre_ubicacion' => 'INVENTARIO',
            'id_encargado' => 0,
            'nombre_encargado' => 'almacen',
        ]);

        movimientos::create([
            'departamento_origen' => $this->empleado->nombre_departamento,
            'departamento_destino' => 'inventario',
            'usuario_origen' => $this->empleado->nombre,
            'usuario_destino' => 'almacen',
            'nombre_articulo' => $this->equipo->nombre_categoria,
            'id_articulo' => $this->equipo->id,
        ]);

        categorias::where('id', $this->equipo->id_categoria)
        ->increment('cantidad_inv');
    }

    public function render()
    {

        return view('livewire.components.td');
    }
}
