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
    <link href="/css/app.css" rel="stylesheet">
    

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
    <!-- Tabs Above -->
<div class='tabs-x tabs-above tabs-krajee'>
    <ul id="myTab-1" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home-1" role="tab" data-toggle="tab">Home</a></li>
        <li><a href="#profile-1" role="tab-kv" data-toggle="tab">Profile</a></li>
        <li class="dropdown">
            <a href="#" id="myTabDrop-1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop-1">
                <li><a href="#dropdown-1-1" tabindex="-1" role="tab" data-toggle="tab">Option 1</a></li>
                <li><a href="#dropdown-1-2" tabindex="-1" role="tab" data-toggle="tab">Option 2</a></li>
            </ul>
        </li>
        <li class="disabled"><a href="#disabled-1"><i class="glyphicon glyphicon-knight"></i> Disabled</a></li>
    </ul>
    <div id="myTabContent-1" class="tab-content">
        <div class="tab-pane fade in active" id="home-1"><p>...</p></div>
        <div class="tab-pane fade" id="profile-1"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-1-1"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-1-2"><p>...</p></div>
        <div class="tab-pane fade" id="disabled-1">Disabled Content</div>
    </div>
</div>
 
<!-- Tabs Below -->
<div class='tabs-x tabs-below tabs-krajee'>
    <div id="myTabContent-2" class="tab-content">
        <div class="tab-pane fade in active" id="home-2"><p>...</p></div>
        <div class="tab-pane fade" id="profile-2"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-2-1"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-2-2"><p>...</p></div>
        <div class="tab-pane fade" id="disabled-2">Disabled Content</div>
    </div>
    <ul id="myTab-2" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home-2" role="tab" data-toggle="tab">Home</a></li>
        <li><a href="#profile-2" role="tab-kv" data-toggle="tab">Profile</a></li>
        <li class="dropdown">
            <a href="#" id="myTabDrop-2" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop-1">
                <li><a href="#dropdown-2-1" tabindex="-1" role="tab" data-toggle="tab">Option 1</a></li>
                <li><a href="#dropdown-2-2" tabindex="-1" role="tab" data-toggle="tab">Option 2</a></li>
            </ul>
        </li>
        <li class="disabled"><a href="#disabled-2"><i class="glyphicon glyphicon-knight"></i> Disabled</a></li>
    </ul>
</div>
 
<!-- Tabs Left -->
<div class='tabs-x tabs-left tabs-krajee'>
    <ul id="myTab-3" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home-3" role="tab" data-toggle="tab">Home</a></li>
        <li><a href="#profile-3" role="tab-kv" data-toggle="tab">Profile</a></li>
        <li class="dropdown">
            <a href="#" id="myTabDrop-3" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop-1">
                <li><a href="#dropdown-3-1" tabindex="-1" role="tab" data-toggle="tab">Option 1</a></li>
                <li><a href="#dropdown-3-2" tabindex="-1" role="tab" data-toggle="tab">Option 2</a></li>
            </ul>
        </li>
        <li class="disabled"><a href="#disabled-3"><i class="glyphicon glyphicon-knight"></i> Disabled</a></li>
    </ul>
    <div id="myTabContent-3" class="tab-content">
        <div class="tab-pane fade in active" id="home-3"><p>...</p></div>
        <div class="tab-pane fade" id="profile-3"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-3-1"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-3-2"><p>...</p></div>
        <div class="tab-pane fade" id="disabled-3">Disabled Content</div>
    </div>
</div>
 
<!-- Tabs Right -->
<div class='tabs-x tabs-right tabs-krajee'>
    <ul id="myTab-4" class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home-4" role="tab" data-toggle="tab">Home</a></li>
        <li><a href="#profile-4" role="tab-kv" data-toggle="tab">Profile</a></li>
        <li class="dropdown">
            <a href="#" id="myTabDrop-4" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop-1">
                <li><a href="#dropdown-4-1" tabindex="-1" role="tab" data-toggle="tab">Option 1</a></li>
                <li><a href="#dropdown-4-2" tabindex="-1" role="tab" data-toggle="tab">Option 2</a></li>
            </ul>
        </li>
        <li class="disabled"><a href="#disabled-4"><i class="glyphicon glyphicon-knight"></i> Disabled</a></li>
    </ul>
    <div id="myTabContent-4" class="tab-content">
        <div class="tab-pane fade in active" id="home-4"><p>...</p></div>
        <div class="tab-pane fade" id="profile-4"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-4-1"><p>...</p></div>
        <div class="tab-pane fade" id="dropdown-4-2"><p>...</p></div>
        <div class="tab-pane fade" id="disabled-4">Disabled Content</div>
    </div>
</div> <!-- end -->
        <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                    <!-- <div class="container"><img src="{{URL::asset('/img/logo.gif')}}" alt="LIQUABIT - Home"> -->
                        {{ config('app.name', 'Certificate Authority') }}
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
</body>
</html>
