@extends('layouts.app')

@section('content')

<div class="container">
    <H2>You are about to revoke this certificate: <strong>{{ $cn }}</strong>.</H2>
    <div class="container">
        <h2>Reason (Optional):</h2>
                {{ Form::open(['url' => 'dashboard/revoked', 'method' => 'post']) }}
                <input type="hidden" name="cn" value="{{ $cn }}">
                  @if($errors->has('cn'))
                  {{ $errors->first('cn') }} 
                  @endif
                <input type="text" class="form-control input-md" name="reason" value="{{ (isset($input['reason'])) ? e($input['reason']) : '' }}" placeholder="Write the reason why you want to revoke this certificate. (Ex. Key compromise)">
                  @if($errors->has('reason'))
                  {{ $errors->first('reason') }} 
                  @endif
                  <br />
                <input type="password" class="form-control input-md" name="password" value="{{ (isset($input['password'])) ? e($input['password']) : '' }}" placeholder="Password">
                   @if($errors->has('password'))
                  {{ $errors->first('password') }} 
                  @endif 
                  <br />
                {{ Form::token() }}
                {{ Form::submit('Are you sure?', ['class' => 'btn btn-danger btn-md']) }}
                {{ Form::close() }}
    </div>            
</div>
@endsection