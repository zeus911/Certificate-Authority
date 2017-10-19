@extends('layouts.app')

@section('content')

<div class="container">

    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>

    <h2>Request New Certificate</h2>

    <p class="text-default">Generates a new CSR/Certificate/Private Key with the data provided in the form.</p>
    <p class="text-info">Separate domain names with <span class="badge badge-dark">Spaces</span>. <strong><a target="_blank" href="https://datatracker.ietf.org/wg/pkix/charter/"/> [PKIX guidelines compatibility]</strong></a></p>

    {{ Form::open(['url' => 'certs/created', 'method' => 'post']) }}
    {{ Form::label('certificate CN[+]SANs: ', 'Certificate CN[+]SANs: ', ['class' => '']) }}
    <input type="text" class="form-control input-md" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="  Example: cn.domain.com cn2domain.com cn3.domain.com.....">
    @if($errors->has('cn'))
        {{ $errors->first('cn') }} 
    @endif
    <br />

    <!-- </br>
    {{ Form::label('Subject Alternative Name (SAN): ', 'Subject Alternative Name (SAN): ', ['class' => '']) }}
    <p class="text-info">Separate SANs with <code>","</code>. <strong><a target="_blank" href="https://datatracker.ietf.org/wg/pkix/charter/"/> [PKIX guidelines compatibility]</strong></a></p>
    <input type="text" class="form-control input-md" name="san" value="{{ (isset($input['san'])) ? e($input['san']) : '' }}" placeholder="  Example: san1.domain.com, san2.domain.com">
    @if($errors->has('san'))
        {{ $errors->first('san') }} 
    @endif
    <br /> -->

    </br>
    {{ Form::label('certificate type: ', 'Certificate Type: ', ['class' => '']) }}
    {{ Form::select('certificate_type', ['SSL/TLS Server' => 'SSL/TLS Server', 'ClientID' => 'Client ID', 'CodeSigning' => 'Code Signing'], null, ['placeholder' => 'Select certificate type', 'class' => 'form-control' ]) }}
        @if($errors->has('certificate_type'))
        {{ $errors->first('certificate_type') }} 
    @endif
    <br />
    </br>
    {{ Form::label('signature algorithm: ', 'Signature Algorithm: ', ['class' => '']) }}
    {{ Form::select('digest_alg', ['sha256' => 'sha256', 'sha384' => 'sha384 - Not implemented', 'sha512' => 'sha512 - Not implemented'], null, ['placeholder' => 'Select Hash Algorithm', 'class' => 'form-control' ]) }}
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
    {{ Form::label('password: ', 'CA Password: ', ['class' => '']) }}
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
