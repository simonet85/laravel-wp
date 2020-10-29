@extends('layouts.app')

@section('content')
    
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    
    <form action="{{ route('login') }}" method="post" class="was-validated">
        @csrf

      <div class="form-group{{$errors->has('email') ? 'has-error' : ''}} has-feedback">
        <input type="email" class="form-control  
        @error('email') is-invalid @enderror" placeholder="Email" name="email"
        value="{{ old('email') }}"  autocomplete="email" autofocus
        >
        <span class="fa fa-envelope form-control-feedback"></span>

        @error('email')
        <span class="help-block">
          <strong>{{ $errors->first('email')}} </strong>
        </span>
        @enderror
      </div>

      <div class="form-group{{$errors->has('password') ? 'has-error' : ''}} has-feedback">
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"  autocomplete="current-password"
        >
        <span class="fa fa-lock form-control-feedback"></span>

        @error('email')
        <span class="help-block">
          <strong>{{ $errors->first('password')}} </strong>
        </span>
        @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck form-check">
            <label>
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    
    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('I forgot my password') }}
    </a>
    @endif

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
