@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center auth-pages">
            <div class="col-md-8">
                <h1 class="main-title mb-3 fw-bold">{{ __('public.login') }}</h1>
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="username"
                                            class="text-md-end fw-bold">{{ __('public.username') }}</label>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required autocomplete="username">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password"
                                            class="text-md-end fw-bold">{{ __('public.password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('public.remember_me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('public.login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-center mt-2" href="{{ route('password.request') }}">
                                            {{ __('public.forgot_your_password') }}
                                        </a>
                                    @endif
                                </form>
                            </div>

                            <div class="col-lg-6">
                                <div class="auth-image">
                                    <img src="{{ asset('assets/images/articles/6.jpg') }}" class="w-100 h-100"
                                        alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
