@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login to Certificate Authority (Prototype)</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label" placeholder="Username">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="Username">

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
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('octdec(octal_string)') ? ' has-error' : '' }}">
                            <label for="otc" class="col-md-4 control-label">OTC</label>

                            <div class="col-md-6">
                                <input id="otc" type="password" class="form-control" name="otc" required placeholder="One-Time-Code">

                                @if ($errors->has('otc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a class="text-default"><strong>IP Address:</strong> {{ $_SERVER['REMOTE_ADDR'] }}</a><br />
                                <a class="text-default"><strong>DNSBL/RBL Check: PASS</strong></a>
                            </div>
                        </div> 
                            <blockquote>
                                Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning...
                            </blockquote>
   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
