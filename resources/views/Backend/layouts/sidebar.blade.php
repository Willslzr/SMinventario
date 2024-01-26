        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-landmark"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SM Admin <sup>v1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-wb fa-solid fa-chart-line"></i>
                    <span>Pagina Principal</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('inventario.index')}}">
                    <i class="fas fa-wb fa-solid fa-table"></i>
                    <span>Inventario</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('personal.index')}}">
                    <i class="fas fa-wb fa-solid fa-table"></i>
                    <span>Personal</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-spell-check"></i>
                    <span>Historial de movimientos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configuracion</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('configuracion.departamentos')}}">Departamentos</a>
                        <a class="collapse-item" href="{{route('configuracion.personal')}}">Personal</a>
                        <a class="collapse-item" href="{{route('configuracion.categorias')}}">Productos</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Complementos
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('test')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Reporte</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <a class="nav-link" onclick="this.closest('form').submit()" href="#">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cerrar Sesion</span></a>
                </form>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
