<!DOCTYPE html>
<html>
    <head>
        <title>Ooops!!!.</title>

        <!-- .ico -->
        <link rel="icon" href="{{URL::asset('tragsa.ico') }}"/>
        <!-- Fonts -->
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<!--        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
-->


         <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: rgba(27, 109, 133, 1);
                display: table;
                font-weight: 100;
                font-family: sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .data { 
                font-size: 20px;
                margin-bottom: 12px;
                color: #000000;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"><strong> {{ $cn }}</div>
                <div class='data'>
                <p>What´s wrong?:</p>
                
                <p class='text-info'>{{ $error_details }}.</p>
                <p>{{ link_to(URL::previous(), 'Go Back', ['class' => 'btn btn-primary btn-lg']) }} </p>         
                </div>
            </div>
        </div>
    </body>
</html>