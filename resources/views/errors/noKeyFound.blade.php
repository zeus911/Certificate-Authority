<!DOCTYPE html>
<html>
    <head>
        <title>Error No Private Key Found.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">No Private Key has been found!.</div>
                <H3 class="text-danger"><strong>There is no Private Key in DB. This is probably becouse they have been generated in another device and signed by This CA.</strong></H3>
                <p class="btn btn-default btn-bg"><a href='{{ URL('dashboard/index') }}'>Go to Dashboard</a></p>
            </div>
        </div>
    </body>
</html>
