<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
=======
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-5052264-7"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments)};
      gtag('js', new Date());

      gtag('config', 'UA-5052264-7');
    </script>

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD

    <title>{{ config('app.name', '') }}</title>
=======
    <title>{{ config('app.name', 'Prototypes') }}</title>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac

    <!-- .ico -->
    <link rel="icon" href="{{URL::asset('favicon.ico') }}"/>

<<<<<<< HEAD
=======

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
    <!-- Styles -->
    <link href="/css/login.css" rel="stylesheet">

    <!-- Fonts -->
<<<<<<< HEAD
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
=======
	<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
<<<<<<< HEAD
</head>
<body>
    <div id="app">
         <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header"> 
        
                            <!-- Collapsed Hamburger -->
        <!--           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
=======

</head>
<body>
    <?php include_once("analyticstracking.blade.php") ?>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
<<<<<<< HEAD
        -->
                    <!-- Branding Image
       	            <a class="navbar-brand" href="{{ url('dashboard/index') }}">
                    <div class="container"><!-- <img src="{{URL::asset('/img/logo.gif')}}" alt="Prototypes - Home"></div>
                        {{ config('app.name', 'Certificate Authority') }}
                    </a>
        -->
                </div>
        </nav>
        
         @yield('content')
    </div>
    <br />
    <!-- footer -->
    <div class="text-info"><center><strong>Prototypes &#128128; 2016 - {{ date('F Y') }}.</strong> <br />
    <strong><i class="fa fa-quote-left" aria-hidden="true"></i>
	Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning...<i class="fa fa-quote-right" aria-hidden="true"></i>
</strong></div>
    <br />
    <!-- Scripts -->
    <script src="/js/app.js"></script>
=======

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                    <!-- <a class="navbar-brand" href="{{ url('/') }}"> -->
                        {{ config('app.name', 'Prototypes') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <!--
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="js/analytics.js"></script>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac

</body>
</html>
