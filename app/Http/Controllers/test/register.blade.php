<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    AVEGARZAS
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
    <main class="main-content mt-0">
        <section>
            <div class="container my-5">
                <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto border box-shadow">
                <div class="card card-plain">
                    <div class="card-header">
                    <h4 class="font-weight-bolder">Registro</h4>
                    <p class="mb-0">Ingresa tus datos para registrarte</p>
                    </div>
                    <div class="card-body">

                    <form action="{{route('register.store')}}" method="POST">
                        @csrf
                        <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Correo</label>
                        <input name="email" type="email" value="{{old('email')}}" class="form-control">

                        </div>
                        <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Confirma Contraseña</label>
                        <input name="password_confirmation" type="password" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nombres</label>
                        <input name="nombres" type="text" value="{{old('nombres')}}" class="form-control">
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Apellidos</label>
                            <input name="apellidos" type="text" value="{{old('apellidos')}}" class="form-control">
                            </div>
                        <p class="mb-1" style="margin-left: 5px;">Fecha de nacimiento</p>
                        <div class="d-flex">
                            <div class="col-md-3 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Dia</label>
                                <input name="dia" value="{{old('dia')}}" type="text" class="form-control col-md-3" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-3 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Mes</label>
                                <input name="mes" value="{{old('mes')}}" type="text" class="form-control col-md-3" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-6 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Año</label>
                                <input class="form-control col-md-3" value="{{old('anno')}}" type="text" name="anno" maxlength="4">
                                </div>
                            </div>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Cedula</label>
                        <input name="cedula" type="text" value="{{old('cedula')}}" class="form-control">
                        </div>

                        <div class="d-flex">
                            <div class="col-md-3 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-control" name="telefono_prefijo">
                                        <option value="0414" @if(old('telefono_prefijo') == '0414') selected @endif>0414</option>
                                        <option value="0424" @if(old('telefono_prefijo') == '0424') selected @endif>0424</option>
                                        <option value="0416" @if(old('telefono_prefijo') == '0416') selected @endif>0416</option>
                                        <option value="0426" @if(old('telefono_prefijo') == '0426') selected @endif>0426</option>
                                        <option value="0412" @if(old('telefono_prefijo') == '0412') selected @endif>0412</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Telefono</label>
                                    <input class="form-control col-md-5" value="{{old('telefono_numero')}}" type="text" name="telefono_numero" maxlength="7">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-md-3 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">N° Manzana</label>
                                    <input class="form-control col-md-5" value="{{old('manzana')}}" type="text" name="manzana" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-3 flex-grow-1">
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">N° Casa</label>
                                    <input class="form-control col-md-5" value="{{old('casa')}}" type="text" name="casa" maxlength="2">
                                </div>
                            </div>
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
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-2 text-sm mx-auto">
                        Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Inicia Sesion</a>
                    </p>
                    </div>
                </div>
                </div>
            </div>

        </section>
    </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
