@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Convert DER to PEM</h2>

    <p class="text-info">Converts certificate in DER format to PEM format (*.pem).</p>
    </br>
<!--
    {{ Form::open(['url' => 'converter/getP12', 'method' => 'post']) }}
    
    {{ Form::label('Select a certifiate file: ', 'Select a Certificate File: ', ['class' => '']) }}
    {{ Form::File('cert', ['placeholder' => 'Select a Certificate...', 'class'=>'' ]) }}
        @if($errors->has('cert'))
        {{ $errors->first('cert') }} 
    @endif
    </br> -->
    <p><strong>Copy &amp Paste your DER certificate content.</strong></p>
    {{ Form::open(['url' => 'converter/getP12', 'files' => 'true', 'method' => 'post']) }}
    {{ Form::textarea('certprint', null, array('placeholder' => '-----BEGIN CERTIFICATE-----
A1UEBxMGTWFkcmlkMRUwEwYDVQQKEwxHUlVQTyBUUkFHU0ExGzAZBgNVBAMTEmVm
YWN0dXJhLnRyYWdzYS5lczCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEB
ALh6+mATYMZoFetFaaL6lFDGoLSblVyhee2mE5hjGJtTQNEtxIX8KjxNj8xdOozy
MIICxDCCAawCAQAwYzELMAkGA1UEBhMCRVMxDzANBgNVBAgTBk1hZHJpZDEPMA0G
A1UEBxMGTWFkcmlkMRUwEwYDVQQKEwxHUlVQTyBUUkFHU0ExGzAZBgNVBAMTEmVm
-----END CERTIFICATE-----', 'class' => 'form-control')) }}
    </br>
    <br />
    {{ Form::token() }}
    {{ Form::submit('Convert & Get DER Certificate', ['class' => 'btn btn-success btn-lg']) }}
    {{ Form::close() }}
	<br />
</div>
@endsection
