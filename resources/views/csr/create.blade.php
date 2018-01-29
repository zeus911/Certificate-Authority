@extends('layouts.app')

@section('content') 

<div class="container">

	  <h2>Request New CSR</h2>      
		
	<p class="text-default">Generate a new CSR/Private Key. This is used for signing certificates with an external CA.</p>
    <p class="text-info">Separate domain names with <span class="badge badge-dark">Spaces</span>. <strong><a target="_blank" href="https://datatracker.ietf.org/wg/pkix/charter/"/> [PKIX guidelines compatibility]</strong></a></p>

    {{ Form::open(['url' => 'csr/created', 'method' => 'post']) }}
    {{ Form::label('certificate CN: ', 'Certificate CN(s): ', ['class' => '']) }}
    <input type="text" class="form-control input-md" name="cn" value="{{ (isset($input['cn'])) ? e($input['cn']) : '' }}" placeholder="  Example: cn.domain.com cn2domain.com cn3.domain.com.....">
    @if($errors->has('cn'))
        {{ $errors->first('cn') }} 
    @endif
    <br />

    <!-- </br>
    {{ Form::label('Subject Alternative Name (SAN): ', 'Subject Alternative Name (SAN): ', ['class' => '']) }}
    <p class="text-info">Separate SANs with <code>","</code>. <strong><a target="_blank" href="https://datatracker.ietf.org/wg/pkix/charter/"/> [PKIX guidelines compatibility]</strong></a></p>
    <input type="text" class="form-control input-sm" name="san" value="{{ (isset($input['san'])) ? e($input['san']) : '' }}" placeholder="  Example: san1.domain.com, san2.domain.com">
    @if($errors->has('san'))
        {{ $errors->first('san') }} 
    @endif
    <br /> -->

    </br>

    {{ Form::label('certificate type: ', 'Certificate Type: ', ['class' => '']) }}
    {{ Form::select('certificate_type', ['SSL/TLS Server' => 'SSL/TLS Server', 'ClienID' => 'Client ID'], null, ['placeholder' => 'Select a type...', 'class' => 'form-control' ]) }}
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

    {{ Form::submit('Generate CSR', ['class' => 'btn btn-success btn-md']) }}

    {{ Form::close() }}

</div>
@endsection
