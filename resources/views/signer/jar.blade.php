@extends('layouts.app')

@section('content')

<div class="container">
    <H1>You are going to sign a Java Archive (JAR).</H1>
    <div class="container">

    {{ Form::open(['url' => 'signer/signJAR', 'method' => 'POST', 'class' => 'form', 'files' => true]) }}
        <div class="form-group">
            {{ Form::label('Select JAR Archive') }}
            {{ Form::file('jar', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('Password') }}
            {{ Form::password('password', ['placeholder' => 'Keystore Password', 'class' => 'form-control' ]) }}
        </div>


        <div class="form-group">
            {{ Form::token() }}
            {{ Form::submit('Submit Data', ['class' => 'btn btn-primary btn-lg']) }}
        </div>
        {{ Form::close() }}
        </div>

    </div>

@endsection