@extends('layouts.app')

@section('content')

<div class="container">
      
    <h2>Do you really want to delete {{ $cn }} form DB.</h2>
    </br>
    {{ Form::open(['url' => 'certs/mgmt/deleted', 'files' => 'true', 'method' => 'post']) }}
    <input class="hidden" type="text" name="cn" value="{{ $cn }}">
    </br>
    <br />
    {{ Form::token() }}
    {{ Form::submit('Delete Certificate', ['class' => 'btn btn-danger btn-md']) }}
    {{ Form::close() }}
    </div>
    <br />
</div>
@endsection
