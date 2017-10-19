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

<<<<<<< HEAD
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
=======
        <title>Prototypes</title>
        
        <link href="/css/app.css" rel="stylesheet">
	
	   <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="css/welcome.css">

     <!-- Fonts -->
		    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
 
        
    </head>
    <body>
        <?php include_once("analyticstracking.blade.php") ?>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="title m-b-md">
               
                    Prototypes

                    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</blockquote>

                </div>

		@if (Route::has('login'))
                <div class="">
                    <a class='btn btn-primary btn-lg' href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                    <a class='btn btn-primary btn-lg' href="{{ url('https://github.com/lopeaa') }}"><i class="fa fa-github" aria-hidden="true"></i> Github</a>
                </div>
               @endif
               <br />

               @include('layouts.footer') 

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
            </div>
        </div>
    </body>
</html>
