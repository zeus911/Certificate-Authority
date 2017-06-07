@extends('layouts.app')

@section('content')

<div class="container">

    <blockquote>Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning..</blockquote>
      <h2>Self-Service</h2>
      <h3>You are going to create a PFX Archive for: {{ $cn }}</h3>

    {{ Form::open(['url' => 'converter/storeP12', 'method' => 'post']) }}
    <input type="hidden" name="cn" value="{{ $cn }}">
    {{ Form::label('password: ', 'Passphrase: ', ['class' => '']) }}
    {{ Form::password('password', ['placeholder' => 'Passphrase', 'class' => 'form-control' ]) }}
        @if($errors->has('password'))
        {{ $errors->first('password') }} 
    @endif     
    <br />
    {{ Form::token() }}
    {{ Form::submit('Submit Data & Get PFX(P12)', ['class' => 'btn btn-primary btn-lg']) }}
    {{ Form::close() }}


</div>
@endsection
