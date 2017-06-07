@extends('layouts.app')
@section('content') 
<div class="container">

        <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
    
      	<H1>Update CSR with Certificate .</H1>
    	<p class='text-info'>Now, You can download the CSR &amp his Private Key archive.</p>

    

    <div class="container">

        <p class='text-info'>You are about to update de certificate for: <strong> {{ $cn }} </strong>.</p>
        {{ Form::open(['url' => 'csr/updateCSRwithCert', 'method' => 'post']) }}
        <input type="hidden" name="cn" value="{{ $cn }}">
        <input type="hidden" name="cert" value="{{ $cn }}">
        
        {{ form::token() }}
        {{ Form::submit('Update', ['class' =>'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
        </br>
   </div>

@endsection    

