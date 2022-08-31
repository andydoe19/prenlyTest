@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel">
        <h3>Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row gtr-uniform">
                <div class="col-12">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="col-12">
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 col-12-small">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                    
                    &nbsp;&nbsp; | &nbsp;&nbsp;

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>

                <div class="col-md-8 offset-md-4">
                    <input type="submit" value="{{ __('Login') }}">
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
