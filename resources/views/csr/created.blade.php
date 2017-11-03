@extends('layouts.app')
@section('content') 
<div class="container">

      	<H2>You have successfully generated the CSR.</H2>
    	<p class='text-info'>Now, You can download the CSR &amp his Private Key archive for: <strong> {{ $cn }} </strong>. </p>

    <div class="container">

        {{ Form::open(['url' => 'csr/getCSR', 'method' => 'post']) }}
        <input type="hidden" name="cn" value="{{ $cn }}">
        <input type="hidden" name="san" value="{{ $san }}">
        <input type="hidden" name="certificate_type" value="{{ $certificate_type }}">
        <input type="hidden" name="digest_alg" value="{{ $digest_alg }}">
        <input type="hidden" name="serial" value="{{ $serial }}">
        <input type="hidden" name="csrprint" value="{{ $csrprint }}">
        <input type="hidden" name="certprint" value="{{ $certprint }}">
        <input type="hidden" name="keyprint" value="{{ $keyprint }}">
        <input type="hidden" name="p12" value="{{ $p12 }}">

        
        {{ form::token() }}
        {{ Form::submit('Download CSR', ['class' =>'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
        </br>
        <a class='text-success' href="https://gestion6.tragsa.es/ssldecoder/" target="_blank"><strong> Check your CSR (SSL Decoder Tools) </strong></a>
        <br />
        <a class='text-success' href="https://cryptoreport.websecurity.symantec.com/checker/views/csrCheck.jsp" target="_blank"><strong> Check your CSR (Symantec CryptoReport) </strong></a>
        
   </div>

@endsection    

