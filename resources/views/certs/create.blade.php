@extends('layouts.app')

@section('content')

<div class="container">

    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
      <h2>Self-Service</h2>
      <h3>Request New Certificate</h3>

    <p class="text-info">Generate New Certificates with the <strong>Common Name, Type and Hash</strong> provided in the form.</p>
    <p class="text-danger">You can include up to 3 sub-domains using <code>,</code> to separate them. (Not implemented yet.)</p>
    </br>

    {{ Form::open(['url' => 'certs/created', 'method' => 'post']) }}
    
    {{ Form::label('certificate CN: ', 'Certificate CN(s): ', ['class' => '']) }}
    <input type="text" class="form-control input-lg" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="  Example: cn1.domain.com, cn2.domain.com">
    @if($errors->has('cn'))
        {{ $errors->first('cn') }} 
    @endif
    <br />
    </br>
    {{ Form::label('certificate type: ', 'Certificate Type: ', ['class' => '']) }}
    {{ Form::select('certificate_type', ['TLS Web Server' => 'TLS Web Server', 'Client Authetication' => 'Client Authetication', 'Code Signing' => 'Code Signing'], null, ['placeholder' => 'Select certificate type', 'class' => 'form-control' ]) }}
        @if($errors->has('certificate_type'))
        {{ $errors->first('certificate_type') }} 
    @endif
    <br />
    </br>
    {{ Form::label('signature algorithm: ', 'Signature Algorithm: ', ['class' => '']) }}
    {{ Form::select('digest_alg', ['sha256' => 'sha256', 'sha384 ' => 'sha384 - Not implemented', 'sha512' => 'sha512 - Not implemented'], null, ['placeholder' => 'Select Hash Algorithm', 'class' => 'form-control' ]) }}
        @if($errors->has('digest_alg'))
        {{ $errors->first('digest_alg') }} 
    @endif     
    <br />
    {{ Form::label('Key Length: ', 'Key Length: ', ['class' => '']) }}
    {{ Form::select('key_length', ['2048' => '2048', '4096' => '4096 - Not implemented'], null, ['placeholder' => 'Select Key Length', 'class' => 'form-control' ]) }}
        @if($errors->has('key_length'))
        {{ $errors->first('key_length') }} 
    @endif     
    <br />
    </br>
    {{ Form::label('password: ', 'Password: ', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control' ]) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }} 
    @endif     
    <br />
    </br>
    {{ Form::token() }}
    {{ Form::submit('Submit Data', ['class' => 'btn btn-success btn-lg']) }}
    {{ Form::close() }}
    <br />
</div>
@endsection
