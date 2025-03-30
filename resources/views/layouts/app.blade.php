<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    
    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    
    <!-- Gentelella Custom Theme -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/styles.css') }}" rel="stylesheet">
    <style>
        .last{
            display: flex;
        }
    </style>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            
            <!-- Sidebar -->
            @include('layouts.sidebar')
            
            <!-- Top Navigation -->
            @include('layouts.topnav')
            
            <!-- Page Content -->
            <div class="right_col" role="main">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @include('layouts.footer')

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
</body>
</html>
