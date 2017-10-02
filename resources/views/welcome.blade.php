<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-5052264-7"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments)};
          gtag('js', new Date());

          gtag('config', 'UA-5052264-7');
        </script>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <a class='btn btn-primary btn-lg' href="{{ url('https://ca.liquabit.com') }}"><i class="fa fa-flask" aria-hidden="true"></i> Labs</a>
                    <a class='btn btn-primary btn-lg' href="{{ url('https://github.com/lopeaa') }}"><i class="fa fa-github" aria-hidden="true"></i></a>
 Github</a>
                </div>
               @endif
               <br />

               @include('layouts.footer') 

            </div>
        </div>
    </body>
</html>
