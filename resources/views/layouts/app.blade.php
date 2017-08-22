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
    <link rel="icon" href="{{URL::asset('favico.ico') }}"/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

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
        <nav class="navbar navbar-default navbar-fixed-top"> <!-- opt: default, static, fixed -->
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

{{--                     <!-- Branding Image -->
                    <a class="navbar-brand nav" href="{{ url('dashboard/index') }}">
                    <div class="container"><img src="{{URL::asset('/img/logo.gif')}}" alt="LIQUABIT - Home"></div>
               
                        {{ config('app.name', '') }}
                    </a>
--}}                </div>

                <br />
                <br />
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
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
                        <li><a href="{{ url('le/index') }}">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                        <strong>Let's Encrypt CSR Signer</strong></a>
                        </li>
                        <li>
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal1">Search</button>

                        <a><strong>Search</strong></a>
                                                <div id="myModal1" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Search certificate by CommonName</h4>
                          </div>
                          <div class="modal-body">
                            <p>Type complete CommonName.</p>
                            {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post', 'class' => 'navbar-form navbar-left']) }}
                        {{csrf_field()}}
                        {{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}
                        <input class="form-control input-sm" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by CN">
                        @if($errors->has('cn'))
                            {{ $errors->first('cn') }} 
                        @endif
                        <br />
                        {{ Form::token() }}
                        {{ Form::close() }}    
                          </div>
                          <div class="modal-footer">
                               <!-- // Button to download CSR to a file. // -->
                                {{ Form::open(['url' => 'dashboard/search', 'method' => 'post']) }}
                                    {{csrf_field()}}
                                    <input class="hidden" type="text" name="cn" value="{{ $cn }}"> 
                                    @if($errors->has('cn'))
                                        {{ $errors->first('cn') }} 
                                    @endif
                                    <br />
                                    {{ Form::token() }}
                                    {{ Form::submit('Go', ['class' => 'btn btn-primary btn-md']) }}
                                    {{ Form::close() }}
                                </br>
                                <!-- // End Button to download CSR to a file. // -->
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>                        
                        </li>
                        &nbsp;

                    </ul>
                   <!-- Search form -->
{{--                     <div>
                        {{ Form::open(['url' => 'dashboard/search/', 'method' => 'post', 'class' => 'navbar-form navbar-left']) }}
                        {{csrf_field()}}
                        {{ Form::label('Common Name: ', 'Common Name: ', ['class' => '']) }}
                        <input class="form-control input-sm" type="text" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="Search by CN">
                        @if($errors->has('cn'))
                            {{ $errors->first('cn') }} 
                        @endif
                        <br />
                        {{ Form::token() }}
                        {{ Form::close() }}    
                    </div>
 --}}                    
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
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
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
                                        <!-- Search form -->
{{--                     <div>
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
 --}}
                </div>
            </div>
        </nav>

        @yield('content')

    </div>
    <br />
    <!-- footer -->
    <div class="text-info"><center>LIQUABIT &#128128; 2016 - {{ date('F Y') }}.</center></div>
    <br />
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
