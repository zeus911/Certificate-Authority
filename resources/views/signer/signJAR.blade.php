@extends('layouts.app')

@section('content')

<div class="container">
    <H1>Your archive {{ $jar_name }} has been:</H1>
    <H3 class="text-info">{{ $result }}</H3>
    <div class="container">
        {{ Form::open(['url' => 'signer/getJAR', 'method' => 'post']) }}
        <input type="hidden" name="jar_name" value="{{ $jar_name }}">
        {{ Form::token() }}
        {{ Form::submit('Get Signed JAR', ['class' => 'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
            
    </div>

@endsection