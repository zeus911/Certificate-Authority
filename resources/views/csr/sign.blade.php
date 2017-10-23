@extends('layouts.app')

@section('content') 

<div class="container">

      <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
      <h2>Self-Service</h2>
	  <h3>Sign Certificate Request</h3>      
		
	 <p>Generate a new certificate from a given CSR. This is used for signing CSR files generated externally.</p>
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
    {{ Form::label('password', 'Password', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }}
        @endif
    <br />
    </br>
    {{ Form::token() }}
    {{ Form::submit('Submit Data', ['class' => 'btn btn-danger btn-lg']) }}
    {{ Form::close() }}

</div>
@endsection
