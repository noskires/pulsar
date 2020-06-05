@extends('layouts.app')

@section('content')
@include('layout.styles')
<style type="text/css">
    body {background-color: #f1f1f1;}
    .login-box {width: 100%;}
</style>
<div class="container">

<!-- login box -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="login-box">
              <div class="login-logo">
                <a href="#"><b>PULSAR</b>Construction</a>
              </div>
              <!-- /.login-logo -->
                <div class="login-box-body"> <br>
                    <p class="login-box-msg">Please sign in to start your session</p>

                    <form method="POST" action="{{ route('auth') }}">
                        {{ csrf_field() }}

                        <div class="has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="text" class="form-control" name="email" placeholder="ID" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                        <div class="has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <!-- Authentication Error -->
                        @if (session('status'))
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- end::Authentication Error -->

                        <br>
                        <div class="row">
                            <div class="col-xs-8">
                              <a href="#" data-toggle="modal" data-target="#modal-forgotpassword">I forgot my password</a><br>
                            </div>
                            <div class="col-xs-4">
                              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                            </div>
                      </div>
                    </form> <br>
                </div>
            </div>
        </div>
    </div>
<!-- end::login box -->

<!-- forgot password modal -->
    <div class="modal fade" id="modal-forgotpassword">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><span class="glyphicon glyphicon-question-sign"></span> Forgot Password</h4>
          </div>
          <div class="modal-body">
            <p>To recover account, please ask your IT administrator to reset your password.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Got it</button>
          </div>
        </div>
      </div>
    </div>
<!-- end::forgot password modal -->

    <!-- <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-danger" style="text-align:center;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('auth') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</div>
@include('layout.scripts')
@endsection
