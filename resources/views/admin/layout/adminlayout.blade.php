<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - Unity</title>
        @include('admin.include.head')
        @include('admin.include.fonts')
        @yield('headerExtra')
    </head>
    <body>
        <div id="app">
            @include('admin.include.sidebar')
        </div>
        <div id="main">
            @yield('content')
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Unity</p>
                    </div>
                    <div class="float-end">
                        <p>Developed with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://virtuenetz.com">VirtueNetz</a></p>
                    </div>
                </div>
            </footer>
        </div>
        <script src="{{ asset('adminAssets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{ asset('adminAssets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('adminAssets/vendors/apexcharts/apexcharts.js')}}"></script>
        <script src="{{ asset('adminAssets/js/pages/dashboard.js')}}"></script>
        <script src="{{ asset('adminAssets/js/main.js')}}"></script>
        @yield('bodyExtra')
    </body>
</html>
