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
    <link rel="icon" href="{{ URL::asset('tragsa.ico') }}"/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- <link href="/css/bootstrap.css" rel="stylesheet"> -->

 
    <!-- Styles 2
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.min.css') }}"> -->

    <!-- Scripts -->
    <script type="text/javascript" language="javascript" src="{{ URL::asset('js/jquery-1.12.4.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ URL::asset('js/Charts.js') }}"></script>
    {!! $certs_number_issued->script() !!}
    {!! $certs_issued_by->script() !!}
    {!! $certs_status->script() !!}
    {!! $certs_type->script() !!}
    
    <!-- Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
  

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

    </script>

    <script type="text/javascript" class="init">
        $(document).ready(function() {
        $('#dashboard').DataTable();
         var first = $.noConflict(true);
        } );
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top"> <!-- opt: default, static, fixed -->
            <div class="container">
                <div class="navbar-header">
					<a href="{{ url('certs/mgmt/') }}">
						<img src="{{URL::asset('/img/logo.png')}}" alt="CA - Home">
					</a>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
<!--                     <a class="navbar-brand nav" href="{{ url('certs/mgmt') }}">
                    	<div class="container">
                          <img src="{{URL::asset('/img/logo_tragsa.gif')}}" alt="TRAGSA CA - Home"></div>
                         {{ config('app.name', 'Certificate Authority') }}
 						</div>
                    </a> -->
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar">
<!--                    <i class="fa fa-certificate" aria-hidden="true"></i></a>
                        <li class=""><a href="{{ url('certs/mgmt/') }}">
						</li>
 -->                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        		<i class="fa fa-certificate" aria-hidden="true"></i>
                                <strong>Certificates</strong><span class="caret"></span>
                                <ul class="dropdown-menu" role="menu">
 	                                <li class="dropdown-header"><strong><a href="{{ url('dashboard/') }}"><i class="fa fa-pie-chart" aria-hidden="true"></i> DASHBOARDS (Lab)</a></strong></li>
                                	<li class="dropdown-header"><strong>CERTIFICATES</strong></li>
                                    <li><a href="{{ url('certs/mgmt') }}">Certificate Management</a></li>
                                    <li><a href="{{ url('certs/create') }}">Request New Certificate</a></li>
                                    <li><a href="{{ url('csr/create') }}">Request New CSR & Key</a></li>
                                    <li><a href="{{ url('csr/sign') }}">Sign Certificate Request</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>CONVERTER</strong></li> 
                                    <li><a href="{{ url('converter/p12') }}">Convert to PFX/P12</a></li>
                                    <li><a href="{{ url('converter/pem2der') }}">Convert PEM to DER</a></li>
                                    <li><a href="{{ url('converter/der2pem') }}">Convert DER to PEM</a></li>
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
                                <strong>Microsoft Authenticode</strong><span class="caret"></span>
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
                                    <li><a target="_blank" href="{{ url('https://gestion6.tragsa.es/ssldecoder/') }}">
                                    <i class="fa fa-certificate" aria-hidden="true"></i> SSL Decoder (Test)</a></li>
                                    <li><a target="_blank" href="{{ url('https://cryptoreport.websecurity.symantec.com/checker/views/csrCheck.jsp') }}">
                                    <i class="fa fa-external-link" aria-hidden="true"></i> Symantec CryptoReport</a></li>
                                    <li class="divider"></li>
                                   	<li class="dropdown-header"><strong>CERTIFICATE MONITOR</strong></li>
                                    <li><a target="_blank" href="{{ url('https://gestion6.tragsa.es/certmon/') }}">
                                    <i class="fa fa-certificate" aria-hidden="true"></i> Online Certificate Monitor</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header"><strong>LET´S ENCRYPT</strong></li>
                                    <li><a href="{{ url('le/index') }}">
                                    	<i class="fa fa-shield" aria-hidden="true"></i> Let´s Encrypt CSR Signer</a></li>
                                </ul>
                        </li>
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
                                	<i class="fa fa-user-circle" aria-hidden="true"></i>
                                    <strong>{{ Auth::user()->name }} <span class="caret"></span></strong>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                	<li>
                                        <a href="{{ url('/todo') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('todo').submit();">
                                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                                            <strong>To Do</strong>
                                        </a>

                                        <form id="todo" action="{{ url('/todo') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                	<li>
                                        <a href="{{ url('/changelog') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('changelog').submit();">
                                            <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                            <strong>ChangeLog</strong>
                                        </a>

                                        <form id="changelog" action="{{ url('/changelog') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                	<li>
                                        <a href="{{ url('/kb') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('kb').submit();">
                                            <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                            <strong>KnowledgeBase</strong>
                                        </a>

                                        <form id="kb" action="{{ url('/kb') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <strong>Logout</strong>
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
    <br />
    <!-- footer -->
    <!-- <div class="footer navbar-fixed-bottom"> -->
    <footer>
    	<div class="text-info"><center><strong><img src="{{URL::asset('/img/logo_icon_xs.png')}}">LIQUABIT | Prototypes, 2016 - {{ date('F Y') }}.</strong></center></div>
    	<div class="text-muted"><center><strong><i class="fa fa-quote-left" aria-hidden="true"></i> Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning...<i class="fa fa-quote-right" aria-hidden="true"></i></strong></center></div>
    <br />
	</footer>
</div>
    <!-- Scripts --> 
    <script src="/js/app.js"></script>
    <script type="text/javascript">
		var first= $.noConflict(true);
	</script>
</body> 

</html> 
