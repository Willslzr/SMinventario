<div>
    <div class="col-sm-12 aling-center">
        <form action="{{route('inventario.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="foto" class="ml-3">Articulo</label>
                    <select class="form-control" name="articulo" wire:model.live="articulo">
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="Cantidad" class="ml-3">Cantidad de articulos</label>
                    <input type="number" class="form-control form-control-user" name="cantidad" id="cantidad" wire:model="cantidad" @if(!$consumible) disabled @endif>
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="Serie" class="ml-3">Numero de serie</label>
                    <input type="text" class="form-control form-control-user" name="numeroserie" id="numeroserie" placeholder="N°" @if($consumible) disabled @endif>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <img wire:model="imagenReferencia" src="{{ asset($imagenReferencia) }}" alt="{{ $articulo }}" class="img-fluid img-thumbnail" width="300">
            </div>

            @if ($errors->any())
            <div class="alert alert-danger text-dark mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="text-center">
            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-50 mt-4 mb-0">Guardar</button>
            </div>
        </form>

    </div>
</div>
