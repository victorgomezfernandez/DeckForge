@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('images/logo-sm.svg') }}" class="login-logo" alt="deckfoundry">
                <span class="h2 login-header-text">{{ __('login_register.login_to_deckfoundry') }}</span>
            </div>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div>
                    <label for="email">{{ __('login_register.email_address') }}</label>
                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="password">{{ __('login_register.password') }}</label>
                    <div class="col">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror input" name="password"
                            value="{{ old('password') }}" required autocomplete="password" autofocus>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('login_register.remember_me') }}
                        </label>
                    </div>
                </div>
                <div class="form-socials">
                    <a href="{{ url('/google-auth/redirect') }}" class="form-social">
                        <i class="fa-brands fa-google social-icon" style="color: white;"></i> {{ __('login_register.google') }}
                    </a>
                    {{-- <a href="{{ url('/facebook-auth/redirect') }}" class="form-social">
                                <i class="fa-brands fa-facebook" style="color: white;"></i> {{ __('login_register.facebook') }} 
                            </a> --}}
                    <a href="{{ url('/github-auth/redirect') }}" class="form-social">
                        <i class="fa-brands fa-github social-icon" style="color: white;"></i> {{ __('login_register.github') }}
                    </a>
                </div>
                <button type="submit" class="form-submit btn btn-primary login-button">
                    {{ __('login_register.login') }}
                </button>
                {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif --}}
            </form>
        </div>
    </div>
@endsection
