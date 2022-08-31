@extends('layouts.app')

@section('content')
<div class="container reset">
    <div class="panel">
        <h3>{{ __('Reset Password') }}</h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="row gtr-uniform">
                <div class="col-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 offset-md-4">
                    <input type="submit" value="{{ __('Send Password Reset Link') }}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
