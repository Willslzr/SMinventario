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

            <li class="nav-item active">
                <a class="nav-link" href="{{route('inventario.index')}}">
                    <i class="fas fa-wb fa-solid fa-table"></i>
                    <span>Inventario</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('personal.index')}}">
                    <i class="fas fa-wb fa-solid fa-user"></i>
                    <span>Personal</span></a>
            </li>

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
                Reportes
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" target="_blank" href="{{route('reporte.general')}}">
                    <i class="fas fa-fw fa-tv"></i>
                    <span>Reporte Equipos</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" target="_blank" href="{{route('reporte.inventario')}}">
                    <i class="fas fa-fw fa-pen"></i>
                    <span>Reporte Materiales</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" target="_blank" href="{{route('reporte.movimientos')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Reporte Movimientos</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" target="_blank" href="{{route('reporte.reportearticulosrecibidos')}}">
                    <i class="fas fa-fw fa-truck-moving"></i>
                    <span>Reporte Recibidos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Salir
            </div>

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


