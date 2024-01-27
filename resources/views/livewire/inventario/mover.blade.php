<div>
    <div class="col-sm-12 aling-center">
        <form action="{{route('inventario.savemove')}}" method="POST">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="foto" class="ml-3">Nombre</label>
                    <select class="form-control" name="empleado" wire:model.live="empleado">
                        @foreach($personal as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nombre'] }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="Cantidad" class="ml-3">Cantidad de articulos</label>
                    <input type="number" class="form-control form-control-user" min="1" max="{{$total}}" name="cantidad" id="cantidad" wire:model.live="cantidad">
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="Serie" class="ml-3">Restante en inventario</label>
                    <input type="text" class="form-control form-control-user" name="restante" id="restante" wire:model="restante" disabled>
                </div>
            </div>

            <div class="form-group row">
            <div class="col-md-6 text-center">
                <img wire:model="imagenReferencia" src="{{ asset($imagenReferencia) }}" alt="{{ $empleado }}" class="img-fluid img-thumbnail" width="300">
            </div>

            <div class="col-md-6 text-center">
                <img wire:model="imagenReferencia" src="{{ asset($imagenproducto) }}" alt="{{ $producto->nombre }}" class="img-fluid img-thumbnail" width="300">
            </div>
            </div>
            <input type="text" class="form-control form-control-user" name="producto" id="producto" value="{{$producto->id}}" hidden>
            <input type="text" class="form-control form-control-user" name="total" id="total" value="{{$total}}" hidden>
            <div class="text-center">
            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-50 mt-4 mb-0">Guardar</button>
            </div>
        </form>

    </div>
</div>
