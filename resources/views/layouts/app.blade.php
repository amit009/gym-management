<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('build/images/favicon.png') }}">
    <!-- Bootstrap & FontAwesome -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('vendors/vendors/starrr/dist/starrr.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    
    <!-- Gentelella Custom Theme -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/styles.css') }}" rel="stylesheet">    
    @livewireStyles
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
    
    @livewireScripts
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>

    <!-- jQuery Smart Wizard -->
    <script src="{{ asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <!-- Switchery -->
    <script src="{{ asset('vendors/switchery/dist/switchery.min.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{ asset('vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    
</body>
</html>
