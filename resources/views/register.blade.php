@include('Backend.layouts.common-head')

<section>
    <div class="container my-5">
        <div class="d-flex flex-column">
            <div class="col-xl-4 col-lg-5 col-md-7 border box-shadow align-self-center">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Registro</h4>
                    <p class="mb-0">Ingresa tus datos para registrarte</p>
                    </div>
                    <div class="card-body">

                    <form action="{{route('register.store')}}" method="POST">
                        @csrf
                        <div class="">
                        <label class="form-label my-2">Correo</label>
                        <input name="email" type="email" value="{{old('email')}}" class="form-control">
                        </div>
                            <div class="">
                            <label class="form-label my-2">Contraseña</label>
                            <input name="password" type="password" class="form-control">
                            </div>
                            <div class="">
                            <label class="form-label my-2">Confirma Contraseña</label>
                            <input name="password_confirmation" type="password" class="form-control">
                            </div>
                            <div class="">
                            <label class="form-label my-2">Nombre y apellido</label>
                            <input name="name" type="text" value="{{old('name')}}" class="form-control">
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
                            <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


@include('Backend.layouts.common-end')
@push('custom-scripts')
@endpush
