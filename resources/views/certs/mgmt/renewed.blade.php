@extends('layouts.app')

@section('content')

<div class="container">

    <H2>Certificate Renewal for: <strong>{{ $cn }}</strong> </H2>

    <div class="container">
    {{ Form::open(['url' => 'certs/mgmt/getRenewed', 'files' => 'true', 'method' => 'post']) }}
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
    {{ Form::submit('Submit Data', ['class' => 'btn btn-primary btn-md']) }}
    {{ Form::close() }}

    </div>
@endsection
