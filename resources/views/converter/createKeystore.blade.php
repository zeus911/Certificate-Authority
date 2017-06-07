@extends('layouts.app')

@section('content')

<div class="container">
    <H1>You have created a Java Keystore ({{ $dstalias }}).</H1>
    <H4 class="text-info">{{ $result }}</H4>
    <div class="container">
        {{ Form::open(['url' => 'converter/getKeystore', 'method' => 'post']) }}
        <input type="hidden" name="dstalias" value="{{ $dstalias }}">
        {{ Form::token() }}
        {{ Form::submit('Get Keystore', ['class' => 'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
            
    </div>

@endsection