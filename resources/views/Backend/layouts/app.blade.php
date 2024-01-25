<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.layouts.common-head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('Backend.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="">

                @include('Backend.layouts.header')

                @yield('main-content')
            </div>
            <!-- End of Main Content -->

            @include('Backend.layouts.footer')
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('Backend.layouts.common-end')

    @stack('custom-scripts')
</body>

</html>
