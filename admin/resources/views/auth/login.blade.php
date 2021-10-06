@extends('layouts.login')

@section('content')
<p class="login-box-msg">{{ __('Login') }}</p>

<form action="{{ route('login') }}" method="post">
  @csrf
  <div class="input-group mb-3">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      <div class="input-group-append input-group-text">
          <span class="fas fa-envelope"></span>
      </div>
      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="input-group mb-3">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
      <div class="input-group-append input-group-text">
          <span class="fas fa-lock"></span>
      </div>
      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="row">
    <div class="col-8">
      <div class="icheck-primary">
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">
          Remember Me
        </label>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <!-- /.col -->
  </div>
</form>

@endsection
