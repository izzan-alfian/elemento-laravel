<!doctype html>
<html lang="en">

    @include('layout.header')
    @push('custom-css')
    <style>
        body {
            background-color: #F8F9FD !important;
        }
    </style>
    @endpush

    <body>
        <div id="loader-overlay">
            <div id="loader"></div>
        </div>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="p-10">
                    <div class="brand-logo d-flex align-items-center justify-content-between">
                        <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                            <img src="{{ asset('assets/images/logos/elemento-side.png') }}" width="180" alt="" />
                        </a>
                        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                            <i class="ti ti-x fs-8"></i>
                        </div>
                    </div>
                    <!-- Sidebar navigation-->
                    @include('layout.sidebar')
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!--  Sidebar End -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!--  Header Start -->
                <header class="app-header">
                    @include('layout.header-page')
                </header>
                <!--  Header End -->
                <div class="container-fluid">
                    <!--  Row 1 -->
                    @yield('content')
                </div>
            </div>
        </div>

        @include('layout.script')
        <script src="{{ asset('assets/js/auth.js') }}"></script>
    </body>

</html>
