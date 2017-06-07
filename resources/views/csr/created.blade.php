@extends('layouts.app')
@section('content') 
<div class="container">

        <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
    
      	<H1>You have successfully generated the CSR.</H1>
    	<p class='text-info'>Now, You can download the CSR &amp his Private Key archive.</p>

    

    <div class="container">

        <p class='text-danger'>Download the CSR archive for: <strong> {{ $cn }} </strong>.</p>
        {{ Form::open(['url' => 'csr/getCSR', 'method' => 'post']) }}
        <input type="hidden" name="cn" value="{{ $cn }}">
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
        <a class='text-success' href="https://cryptoreport.websecurity.symantec.com/checker/views/csrCheck.jsp" target="_blank"><strong> Check your CSR Online </strong></a>
        
   </div>

@endsection    

