@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('images/logo-sm.svg') }}" class="login-logo" alt="deckfoundry">
                <span class="h2 login-header-text">{{ __('login_register.register_to_deckfoundry') }}</span>
            </div>
            <form method="POST" action="{{ route('register') }}" class="login-form">
                @csrf
                <div>
                    <label for="name">{{ __('login_register.name') }}</label>
                    <div class="col">
                        <input id="name" type="name"
                            class="form-control @error('name') is-invalid @enderror input" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="email">{{ __('login_register.email_address') }}</label>

                    <div class="col">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror input" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="password"
                        class="col-form-label text-end">{{ __('login_register.password') }}</label>

                    <div class="col">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror input" name="password"
                            required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password-confirm"
                        class="col-form-label text-end">{{ __('login_register.confirm_password') }}</label>

                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control input"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <button type="submit" class="form-submit btn btn-primary login-button">
                    {{ __('login_register.register') }}
                </button>
            </form>
        </div>
    </div>
@endsection
