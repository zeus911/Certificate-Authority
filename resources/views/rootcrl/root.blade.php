@extends('layouts.app')

@section('content')

<div class="container">
    <H1>Root certificates.</H1>
    <div class="container">

    {{ Form::open(['url' => 'rootcrl/getRoot', 'method' => 'POST', 'class' => 'form']) }}
        <div class="form-group">
            {{ Form::submit('Get TRAGSA CA G2 Root', ['class' => 'btn btn-primary btn-lg']) }}
        </div>
        {{ Form::close() }}
        </div>

    </div>

@endsection