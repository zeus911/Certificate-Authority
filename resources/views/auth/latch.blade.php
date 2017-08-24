<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
@extends('layouts.app') 
=======
@extends('layouts.login')
>>>>>>> 2014e3346a9d16969dad98093fcb349c3c762735
=======
@extends('layouts.login') 
>>>>>>> e960d4b6deec62183c1f02a8feb1d08cc9072d33
=======
@extends('layouts.login')
>>>>>>> afd2fc18d548dcae2f5cf9d18d5be3276ce4d59c

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<<<<<<< HEAD
                <div class="panel-heading">Protect your account with Latch</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('auth/latch') }}">
=======
                <div class="panel-heading">Latch</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('auth/latchPair') }}">
>>>>>>> 2014e3346a9d16969dad98093fcb349c3c762735
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Latch Token</label>

                            <div class="col-md-6">
                                <input id="token" type="password" class="form-control" name="token" required>

                                @if ($errors->has('token'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Pair
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
