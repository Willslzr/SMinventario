@extends('Backend.layouts.app')
@section('main-content')

<style>
    /* Para quitar los bordes del input file */
    input[type="file"] {
        border: none;
        outline: none;
    }
</style>
<section>
    <x-card>
        <x-slot name="header">
                <h4 class="text-white text-capitalize ps-3">Departamentos</h4>
        </x-slot>
        <x-slot name="body">
            <div class="container">
                <div class="row">


                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header bg-gradient-primary text-white">
                            <h5 class="font-weight-bolder">Registrar</h5>
                            <p class="mb-0">Nuevo departamento</p>
                            </div>
                            <div class="card-body">

                            <form action="{{route('configuracion.departamentos.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nombre" id="nombre" placeholder="Nombre">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control form-control-user" name="descripcion" id="descripcion" placeholder="Descripcion..." style="height: auto" rows="5"></textarea>
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
                                <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Guardar</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        @livewire('configuracion.departamentos.index')
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>

</section>

@endsection
