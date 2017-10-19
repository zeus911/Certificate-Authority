@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<<<<<<< HEAD
                <div class="panel-heading">Login to Prototypes</div>
=======
                <div class="panel-heading">Login</div>
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
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
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<<<<<<< HEAD
=======
                        <div class="form-group{{ $errors->has('otc') ? ' has-error' : '' }}">
                            <label for="otc" class="col-md-4 control-label">OTC</label>

                            <div class="col-md-6">
                                <input id="otc" type="password" class="form-control" name="otc" required>

                                @if ($errors->has('otc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
<<<<<<< HEAD
                                <button type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
=======
                                <button type="submit" class="btn btn-primary">
>>>>>>> cae4656c6a9ff00c25dfaaa2d9a011c70c3abcac
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
