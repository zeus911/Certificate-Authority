@extends('layouts.app')

@section('content')

<div class="container">
    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
    <H1>Certificate Renewal for: <strong>{{ $cn }}</strong> </H1>
  

    <div class="container">
    {{ Form::open(['url' => 'dashboard/getRenewed', 'files' => 'true', 'method' => 'post']) }}
    <input type="hidden" name="cn" value="{{ $cn }}">
    <input type="hidden" name="csrprint" value="{{ $csrprint }}">
    {{ Form::label('password', 'Password', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }}
        @endif
    <br />
    </br>
    {{ Form::token() }}
    {{ Form::submit('Submit Data', ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}    
           
        
    </div>
@endsection