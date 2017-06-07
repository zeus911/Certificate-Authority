@extends('layouts.app')

@section('content')

<div class="container">
    <H1>You are going to sign a Microsoft Archive.</H1>
    <div class="container">

    {{ Form::open(['url' => 'signer/signAuthenticode', 'method' => 'POST', 'class' => 'form', 'files' => true]) }}
		<div class="form-group">
		    {{ Form::label('Select Microsoft Archive') }}
		    {{ Form::file('archive', null) }}
		</div>
		<div class="form-group">
			{{ Form::label('Archive Type: ', 'Archive Type: ', ['class' => '']) }}
        	{{ Form::select('archive_type', ['.msi' => 'MSI', '.exe' => 'EXE', '.dll' => 'DLL', '.cab' => 'CAB'], null, ['placeholder' => 'Microsoft Archive Type', 'class' => 'dropbox' ]) }}
        	@if($errors->has('archive_type'))
            {{ $errors->first('archive_type') }} 
        	@endif
        <div>
        <div class="form-group">
		    {{ Form::label('Keystore Passphrase') }}
		    {{ Form::password('password', null, ['placeholder' => 'Keystore passphrase', 'class' => 'form-control' ]) }}
		</div>

		<div class="form-group">
	        {{ Form::token() }}
		    {{ Form::submit('Submit & Sign MS Archive', ['class' => 'btn btn-primary btn-lg']) }}
		</div>
	{{ Form::close() }}
		</div>

    </div>

@endsection