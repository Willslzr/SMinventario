@include('Backend.layouts.common-head')

<style>
body {
        background-image: url('/images/santiagologo.svg');
        background-size: cover;

}
</style>
<section class=body>
    <div class="container my-5">
        <div class="d-flex flex-column">
            <div class="col-xl-4 col-lg-5 col-md-7 border rounded bg-gradient-light box-shadow align-self-center">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Iniciar Sesion</h4>
                    <p class="mb-0">Ingresa tus datos y contraseña</p>
                    </div>
                    <div class="card-body">
                    <form action="{{route('login.auth')}}" method="POST">
                        @csrf
                        <div>
                        <label class="form-label my-2">Correo</label>
                        <input name="email" type="email" class="form-control">
                        </div>
                        <div>
                        <label class="form-label my-2">Contraseña</label>
                        <input name="password" type="password" class="form-control">
                        </div>
                        <div class="form-check form-check-info text-start ps-0 my-3">
                            <input class="form-check-input" name="remember" type="checkbox" id="flexCheckDefault" checked>
                            <label class="form-check-label" for="flexCheckDefault">recuerdame</label>
                            </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Iniciar Sesion</button>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="alert alert-danger text-dark mt-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</section>

@include('Backend.layouts.common-end')
