@extends('layouts.app')

@section('content')

<div class="container">
    <H1>CRL Updated. {{ $result }}</H1>
</div>
<div class="container">
    {{ Form::open(['url' => 'rootcrl/getCRL', 'method' => 'POST', 'class' => 'form']) }}
        <div class="form-group">
            {{ Form::submit('Get TRAGSA CA G2 CRL', ['class' => 'btn btn-primary btn-lg']) }}
        </div>
        {{ Form::close() }}
    </div>

</div>

@endsection