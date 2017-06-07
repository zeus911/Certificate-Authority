<!DOCTYPE html>
<html>
    <head>
        <title>CSR Error.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="theme.css">
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
                text-align: left;
                color: #000000;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Error Creating the CSR.</div>
                <div class='data'>
                <p>All this info should be filled up:</p>
                
                <p>Common Name:</p>
                <p>Certificate Type: </p>
                <p>Signing Algorithm:</p>
                <p>CSR: 'Received'</p>
                <p>Private: Status: 'Received'</p>
                <p>Password: 'Bad password'</p>
                <p>  {{ link_to(URL::previous(), 'Go Back', ['class' => 'btn btn-info btn-bg']) }} </p>
                    
                </div>
            </div>
        </div>
    </body>
</html>
