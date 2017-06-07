<!DOCTYPE html>
<html>
    <head>
        <title>getExtCert Error.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

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
                <div class="title">Error Signing the Certificate.</div>
                <div class='data'>
                <p>getExtCertError Info:</p>
                
                <p>Common Name: {{ $cn }}</p>
                <p>Certificate Type: {{ $certificate_type }} </p>
                <p>Signing Algorithm: {{ $digest_alg }}</p>
                <p>Serial: {{ $serial }} (For reference)</p>
                <p>Already in DB: {{ $cn_exists }}</p>
                <p>CSR: <code>{{ $csr }}</code></p>
                <p>Cert: <code>{{ $cert }}</code></p>
                <p>Key: <code>{{ $key }}</code></p>  
                <p>  {{ link_to(URL::previous(), 'Go Back', ['class' => 'btn btn-primary btn-lg']) }} </p>  
                </div>
            </div>
        </div>
    </body>
</html>