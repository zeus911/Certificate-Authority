<!DOCTYPE html>
<html>
    <head>
        <title>CommonName already exists in DB.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


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
                font-family: 'Lato', sans-serif;
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
                <div class="title"><strong> {{ $cn }} {{ $error_details }}.</div>
                <div class='data'>
                <p>Help info:</p>
                
                <p class='text-info'>In order to generate or sign this certificate, you need to revoke it first.</p>
                <p>  {{ link_to(URL::previous(), 'Go Back', ['class' => 'btn btn-primary btn-lg']) }} </p>         
                </div>
            </div>
        </div>
    </body>
</html>