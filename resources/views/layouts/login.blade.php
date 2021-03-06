<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', '') }}</title>

    <!-- .ico -->
    <link rel="icon" href="{{URL::asset('favicon.ico') }}"/>

    <!-- Styles -->
    <link href="/css/login.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
         <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header"> 
        
                            <!-- Collapsed Hamburger -->
        <!--           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        -->
                    <!-- Branding Image -->
        <!--            <a class="navbar-brand" href="{{ url('dashboard/index') }}">
                    <div class="container"><img src="{{URL::asset('/img/logo_tragsa.gif')}}" alt="TRAGSA CA - Home"></div>
                        {{ config('app.name', 'Certificate Authority') }}
                    </a>
        -->
                </div>
        </nav>
        
         @yield('content')
    </div>
    <br />
    <!-- footer -->
    <div class="text-info"><center><strong><img src="{{URL::asset('/img/tragsa_icon_xs.png')}}">LIQUABIT | Prototypes, 2016 - {{ date('F Y') }}.</strong></center></div>
    <br />
    <!-- Scripts -->
    <script src="/js/app.js"></script>

</body>
</html>
