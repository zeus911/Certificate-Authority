@extends('layouts.app')

@section('content')

<div class="container">

      <h2>You are going to create a PFX Archive for: {{ $cn }}</h2>

    {{ Form::open(['url' => 'converter/storeP12', 'method' => 'post']) }}
    <input type="hidden" name="cn" value="{{ $cn }}">
    {{ Form::label('password: ', 'Passphrase: ', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Passphrase', 'class' => 'form-control' ]) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }} 
    @endif     
    <br />
    {{ Form::token() }}
    {{ Form::submit('Submit Data & Get PFX(P12)', ['class' => 'btn btn-primary btn-md']) }}
    {{ Form::close() }}


</div>
@endsection
