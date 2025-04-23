@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div class="row">
                        <img src="{{ asset('images/logo-sm.svg') }}" style="height: 71px;" alt="Mi Imagen">
                    </div>
                    <div class="row">
                        <span class="h2"
                            style="text-align: center; font-weight: 600;">{{ __('login_register.login_to_deckforge') }}</span>
                    </div>
                </div>
                <div class="login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-2" style="display: flex;">
                            <label for="email" class="row mb-2">{{ __('login_register.email_address') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror row mb-2 input" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2" style="display: flex;">
                            <label for="password" class="row mb-2">{{ __('login_register.password') }}</label>
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror row mb-2 input"
                                    name="password" value="{{ old('password') }}" required autocomplete="password"
                                    autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('login_register.remember_me') }}
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2 w-100">
                            <button type="submit" class="btn btn-primary" style="background-color: #D82596; border: 0px;">
                                {{ __('login_register.login') }}
                            </button>
                        </div>
                        {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
