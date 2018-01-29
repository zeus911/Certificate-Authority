@extends('layouts.app')

@section('content') 

<div class="container">

	  <h2>You are about to generate a new certificate for: {{ $cn }}.</h2>      
      <p class"text-info">This is used for signing CSR files generated externally.</p>
    </br>

    {{ Form::open(['url' => 'csr/getExtCert', 'files' => 'true', 'method' => 'post']) }}
    <input type="hidden" name="cn" value="{{ $cn }}">
    <input type="hidden" name="certificate_type" value="{{ $certificate_type }}">
    <input type="hidden" name="digest_alg" value="{{ $digest_alg }}">
    <input type="hidden" name="serial" value="{{ $serial }}">
    <input type="hidden" name="csrprint" value="{{ $csrprint }}">
    <input type="hidden" name="certprint" value="{{ $certprint }}">
    <input type="hidden" name="keyprint" value="{{ $keyprint }}">
    <input type="hidden" name="p12" value="{{ $p12 }}">
    <input type="hidden" name="password" value="{{ $password }}">
    {{ Form::token() }}
    {{ Form::submit('Sign & Get Certificate', ['class' => 'btn btn-danger btn-md']) }}
    {{ Form::close() }}

</div>
@endsection
