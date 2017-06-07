@extends('layouts.app')

@section('content')

<div class="container">
    <H1>Signature for {{ $archive_name }} has {{ $result }}.</H1>
    <div class="container">
        {{ Form::open(['url' => 'signer/getAuthenticode', 'method' => 'post']) }}
        <input type="hidden" name="archive_name" value="{{ $archive_name }}">
        {{ Form::token() }}
        {{ Form::submit('Get Signed Archive', ['class' => 'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
            
    </div>

@endsection