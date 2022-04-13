<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Perpustakaan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('template/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/modules/fontawesome/css/all.min.css')}}">

    <!-- Specific/Libraries CSS Files -->
    @yield('cssLibraries')
    <link rel="stylesheet" href="{{asset('template/modules/izitoast/css/iziToast.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/components.css')}}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('layouts.components.header')

            @include('layouts.components.sidebar')

            <!-- Main Content -->
            @yield('content')

            @include('layouts.components.footer')
        </div>
    </div>
    
    <!-- General JS Scripts -->
    <script src="{{asset('template/modules/jquery.min.js')}}"></script>
    <script src="{{asset('template/modules/popper.js')}}"></script>
    <script src="{{asset('template/modules/tooltip.js')}}"></script>
    <script src="{{asset('template/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('template/modules/moment.min.js')}}"></script>
    <script src="{{asset('template/js/stisla.js')}}"></script>

    <!-- Specific/Libraries JS Scripts -->
    <script src="{{asset('template/modules/izitoast/js/iziToast.min.js')}}"></script>
    @yield('jsLibraries')

    <!-- Template JS File -->
    <script src="{{asset('template/js/scripts.js')}}"></script>
    <script src="{{asset('template/js/custom.js')}}"></script>
</body>

</html>