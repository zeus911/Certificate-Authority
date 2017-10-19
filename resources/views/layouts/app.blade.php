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
    <link href="/css/app.css" rel="stylesheet">

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
        <nav class="navbar navbar-default navbar-fixed-top"> <!-- opt: default, static, fixed -->
=======
    
</head>
<body>
    <?php include_once("analyticstracking.blade.php") ?>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
<<<<<<< HEAD
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image
                    <a class="navbar-brand nav" href="{{ url('dashboard/index') }}">
                    <div class="container"><img src="{{URL::asset('/img/logo.gif')}}" alt="Prototypes - Home"></div

                    {{ config('app.name', 'Certificate Authority') }}
                    </a> -->
=======
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Prototypes') }}

                    </a>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
<<<<<<< HEAD
                    <ul class="nav navbar-nav navbar">
                        <li class="active"><a href="{{ url('certs/mgmt/') }}">
						<i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        		<i class="fa fa-certificate" aria-hidden="true"></i>
                                <strong>Certificates</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
                                	<li class="dropdown-header"><strong>CERTIFICATES</strong></li>
                                    <li><a href="{{ url('certs/mgmt') }}">Certificate Management</a></li>
                                    <li><a href="{{ url('certs/create') }}">Request New Certificate</a></li>
                                    <li><a href="{{ url('csr/create') }}">Request New CSR & Key</a></li>
                                    <li><a href="{{ url('csr/sign') }}">Sign Certificate Request</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>PFX/P12 ARCHIVES</strong></li> 
                                    <li><a href="{{ url('converter/p12') }}">Convert to PFX/P12</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>JAVA KEYSTORE</strong></li>
                                    <li><a href="{{ url('converter/keystore') }}">Create Keystore</a></li>
                                </ul>
                        </li>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <strong>JAR Signer</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('signer/jar') }}">Sign a JAVA Archive</a></li>
                                    <li class="disabled"><a href="{{ url('signer/search') }}">Search for Archives</a></li>
                                </ul>
                        </li>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-windows" aria-hidden="true"></i>
                                <strong>MS Authenticode</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('signer/authenticode') }}">Sign a Microsoft Archive</a></li>
                                    <li class="disabled"><a href="{{ url('signer/search') }}">Search for Archives</a></li>
                                </ul>
                        </li>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                <strong>Root & CRL</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
                                	<li class="dropdown-header"><strong>ROOT CERTIFICATES</strong></li>
                                    <li><a href="{{ url('rootcrl/root') }}">Download Root Certificate</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>CERTIFICATES REVOCATION LIST</strong></li>
                                    <li><a href="{{ url('rootcrl/crl') }}">Update & Download CRL</a></li>
                                </ul>
                        </li>
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-wrench " aria-hidden="true"></i>
                                <strong>SSL Tools</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
                                	<li class="dropdown-header"><strong>SSL DECODER</strong></li>
                                    <li><a target="_blank" href="{{ url('https://ssldecoder.liquabit.com/') }}">
                                    <i class="fa fa-certificate" aria-hidden="true"></i> SSL Decoder</a></li>
                                    <li><a target="_blank" href="{{ url('https://cryptoreport.websecurity.symantec.com/checker/views/csrCheck.jsp') }}">
                                    <i class="fa fa-external-link" aria-hidden="true"></i> Symantec CryptoReport</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>LET´S ENCRYPT</strong></li>
                                    <li><a href="{{ url('le/index') }}">
                                    	<i class="fa fa-shield" aria-hidden="true"></i> Let´s Encrypt CSR Signer</a></li>
                                </ul>
                        </li>
                        &nbsp;
                    </ul>
	               <!-- Search form
                    <div>
                        {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post', 'class' => 'navbar-form navbar-left']) }}
                        {{csrf_field()}}
                        <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}
                        <input class="form-control input-sm" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by CN">
                        @if($errors->has('cn'))
                            {{ $errors->first('cn') }}
                        @endif
                        <br />
                        {{ Form::token() }}
                        {{ Form::close() }}
                    </div>
-->
=======
                    <ul class="nav navbar-nav">
                    </ul>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
<<<<<<< HEAD
                           <!--
                           <li><a href="{{ url('/login') }}">Login</a></li>
                           <li><a href="{{ url('/register') }}">Register</a></li>
                           -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                	<i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <strong>{{ Auth::user()->name }} <span class="caret"></span></strong>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                	<li>
                                        <a href="{{ url('/changelog') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('changelog').submit();">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <strong>ChangeLog</strong>
                                        </a>

                                        <form id="changelog" action="{{ url('/changelog') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

=======
                        <!--
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        -->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="text-danger">
                                    <a href="{{ url('auth/latch') }}"><i class="fa fa-shield" aria-hidden="true"></i> Latch</a>
                                    </li>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
<<<<<<< HEAD
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <strong>Logout</strong>
=======
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Logout
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
<<<<<<< HEAD
=======

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                                </ul>
                            </li>
                        @endif
                    </ul>
<<<<<<< HEAD
                                        <!-- Search form -->
                    <div>
                        {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post', 'class' => 'navbar-form navbar-left']) }}
                        {{csrf_field()}}
                        <!--{{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}-->
                        <input class="form-control input-sm" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by CN">
                        @if($errors->has('cn'))
                            {{ $errors->first('cn') }} 
                        @endif
                        <br />
                        {{ Form::token() }}
                        {{ Form::close() }}    
                    </div>

=======
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                </div>
            </div>
        </nav>

        @yield('content')

    </div>
<<<<<<< HEAD
    <br />
    <!-- footer -->
    <div class="text-info"><center>Prototypes &#128128; 2016 - {{ date('F Y') }}.</center></div>
    <br />
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
=======

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="js/analytics.js"></script>
</body> 
    <br />
        <center>@include('layouts/footer')</center>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
</html>
