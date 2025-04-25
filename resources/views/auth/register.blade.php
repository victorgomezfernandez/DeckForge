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
                            style="text-align: center; font-weight: 600;">{{ __('login_register.register_to_deckfoundry') }}</span>
                    </div>
                </div>
                <div class="register-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-2" style="display: flex;">
                            <label for="name" class="row mb-2">{{ __('login_register.name') }}</label>
                            <div class="col-md-12">
                                <input id="name" type="name"
                                    class="form-control @error('name') is-invalid @enderror row mb-2 input" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback row mb-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2" style="display: flex;">
                            <label for="email" class="row mb-2">{{ __('login_register.email_address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror row mb-2 input" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback row mb-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2" style="display: flex;">
                            <label for="password"
                                class="row mb-2 col-form-label text-md-end">{{ __('login_register.password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror row mb-2 input"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback row mb-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2" style="display: flex;">
                            <label for="password-confirm"
                                class="row mb-2 col-form-label text-md-end">{{ __('login_register.confirm_password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control row mb-2 input"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-2 w-100">
                            <button type="submit" class="btn btn-primary" style="background-color: #D82596; border: 0px;">
                                {{ __('login_register.register') }}
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
