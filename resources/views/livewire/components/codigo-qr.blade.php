<div>
    <button class="btn btn-success mx-1 btn-circle btn-sm" type="button" data-toggle="modal" data-target="#codigoqr">
        <i class="fas fa-qrcode"></i>
    </button>
    <div wire:ignore.self class="modal fade" id="codigoqr" tabindex="-1" role="dialog" aria-labelledby="codigoqrLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="codigoqrLabel"></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                        <h1>SMinventario</h1>
                        <div class="visible-print text-center">{{ QrCode::size(150)
                            ->format('svg')
                            ->merge(public_path('images/santiagologo.svg'), .3, true)
                            ->generate(
                                'ID: ' . $articulo->id . PHP_EOL .
                                'Articulo: ' . $articulo->nombre_categoria . PHP_EOL .
                                'Ubicacion: ' . $articulo->nombre_ubicacion . PHP_EOL .
                                'Asignado a: ' . $articulo->nombre_encargado . PHP_EOL .
                                'Numero de serie: ' . $articulo->numero_de_serie . PHP_EOL .
                                'Asignado el: ' . $articulo->updated_at
                            ) }}
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" id="codigoqr-departamento" data-dismiss="modal" wire:click="codigoqr">Guardar</button>
                    </div>
            </div>
        </div>
    </div>

</div>
