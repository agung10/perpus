<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Perpustakaan</title>
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('template/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/modules/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('template/modules/izitoast/css/iziToast.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/components.css')}}">
</head>

<body>
    <div id="app">
        <section class="section">
            @yield('content')
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('template/modules/jquery.min.js')}}"></script>
    <script src="{{asset('template/modules/popper.js')}}"></script>
    <script src="{{asset('template/modules/tooltip.js')}}"></script>
    <script src="{{asset('template/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('template/modules/moment.min.js')}}"></script>
    <script src="{{asset('template/js/stisla.js')}}"></script>

    <script src="{{asset('template/modules/izitoast/js/iziToast.min.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('template/js/scripts.js')}}"></script>
    <script src="{{asset('template/js/custom.js')}}"></script>

    @include('layouts.components.alert')
</body>

</html>