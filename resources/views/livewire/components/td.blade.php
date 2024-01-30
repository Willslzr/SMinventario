<div>
    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#regresar">
        <i class="fas fa-undo"></i>
    </button>
    <div wire:ignore.self class="modal fade" id="regresar" tabindex="-1" role="dialog" aria-labelledby="regresarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="regresarLabel"></h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                    <h5 id="regresarLabel">Seguro que quiere regresar el equipo al inventario</h5>
                        <input type="text" class="form-control-plaintext w-100 font-weight-bold text-truncate mx-3" value="{{$nombre}}" readonly>
                    </div>
                    <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" id="regresar-departamento" data-dismiss="modal" wire:click="regresar">Enviar al inventario</button>
                    </div>
            </div>
        </div>
    </div>
</div>

