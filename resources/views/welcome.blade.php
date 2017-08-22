<!DOCTYPE html>
<html lang="en">
    <head>
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
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="title m-b-md">
               
                    Prototypes

                    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</blockquote>

                </div>

		@if (Route::has('login'))
                <div class="">
                    <a class='btn btn-primary btn-lg' href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                    <a class='btn btn-primary btn-lg' href="{{ url('https://github.com/lopeaa') }}"><i class="fa fa-github" aria-hidden="true"></i>
 Github</a>
                </div>
               @endif
               <br />

               @include('layouts.footer') 

            </div>
        </div>
    </body>
</html>
