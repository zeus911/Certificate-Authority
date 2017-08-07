<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prototypes</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        
        <link href="/css/app.css" rel="stylesheet">
	
	   <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="css/welcome.css">
        
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
                    <a class='btn btn-primary btn-lg' href="{{ url('/login') }}">Login</a>
                    <a class='btn btn-primary btn-lg' href="{{ url('https://github.com/lopeaa') }}">Github</a>
                </div>
               @endif
               <br />
<<<<<<< HEAD
<<<<<<< HEAD
               @include('layouts.footer')
               <div class="footer">
               <strong>&#128128; Lopeaa, 2015 - {{ date('Y') }}.</strong>
               </div>
=======

               @include('layouts.footer')

>>>>>>> f37235422b7aa9c95fa494e117a442dd064d7d32
=======

               @include('layouts.footer')

>>>>>>> f37235422b7aa9c95fa494e117a442dd064d7d32
            </div>
        </div>
    </body>
</html>
