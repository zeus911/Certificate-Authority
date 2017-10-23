@extends('layouts.app')

@section('content') 

<div class="container">

      <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
      <h2>Self-Service</h2>
	  <h3>Request New CSR</h3>      
		
	 <p class="text-info">Generate New Certificates server Request. This is used for signing certificates with an external CA.</p>
    </br>

    {{ Form::open(['url' => 'csr/created', 'method' => 'post']) }}
    
    {{ Form::label('certificate CN: ', 'Certificate CN(s): ', ['class' => '']) }}
    <input type="text" class="form-control input-lg" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="  Example: www.domain.com">
    @if($errors->has('cn'))
        {{ $errors->first('cn') }} 
    @endif
    <br />
    </br>
    {{ Form::label('certificate type: ', 'Certificate Type: ', ['class' => '']) }}
    {{ Form::select('certificate_type', ['WebserverTLS' => 'Webserver TLS', 'ClienID' => 'Client ID'], null, ['placeholder' => 'Select a type...', 'class' => 'form-control' ]) }}
        @if($errors->has('certificate_type'))
        {{ $errors->first('certificate_type') }} 
    @endif
    <br />
    </br>
    {{ Form::label('signature algorithm: ', 'Signature Algorithm: ', ['class' => '']) }}
    {{ Form::select('digest_alg', ['sha256' => 'sha256', 'sha384' => 'sha384 - Not implemented', 'sha512' => 'sha512 - Not implemented'], null, ['placeholder' => 'Select Hash...', 'class' => 'form-control' ]) }}
        @if($errors->has('digest_alg'))
        {{ $errors->first('digest_alg') }} 
    @endif     
    <br />
    </br>
    {{ Form::token() }}

    {{ Form::submit('Generate CSR', ['class' => 'btn btn-success btn-lg']) }}

    {{ Form::close() }}

</div>
@endsection
