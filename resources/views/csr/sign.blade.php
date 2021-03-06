@extends('layouts.app')

@section('content') 

<div class="container">

	  <h2>Sign Certificate Request</h2>      
		
	 <p class="text-info">Generate a new certificate from a given CSR. This is used for signing CSR files generated externally.</p>
    </br>
    <p><strong>Copy &amp Paste your CSR content.</strong></p>
    {{ Form::open(['url' => 'csr/signed', 'files' => 'true', 'method' => 'post']) }}
    {{ Form::textarea('csrprint', null, array('placeholder' => '-----BEGIN CERTIFICATE REQUEST-----
MIICxDCCAawCAQAwYzELMAkGA1UEBhMCRVMxDzANBgNVBAgTBk1hZHJpZDEPMA0G
A1UEBxMGTWFkcmlkMRUwEwYDVQQKEwxHUlVQTyBUUkFHU0ExGzAZBgNVBAMTEmVm
YWN0dXJhLnRyYWdzYS5lczCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEB
ALh6+mATYMZoFetFaaL6lFDGoLSblVyhee2mE5hjGJtTQNEtxIX8KjxNj8xdOozy
MIICxDCCAawCAQAwYzELMAkGA1UEBhMCRVMxDzANBgNVBAgTBk1hZHJpZDEPMA0G
-----END CERTIFICATE REQUEST-----', 'class' => 'form-control')) }}
    
    <br />
    </br>
    {{ Form::label('password', 'CA Password', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }}
        @endif
    <br />
    </br>
    {{ Form::token() }}
    {{ Form::submit('Sign CSR', ['class' => 'btn btn-success btn-md']) }}
    {{ Form::close() }}

</div>
@endsection
