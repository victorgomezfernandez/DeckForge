@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row pricing-header">
            <span class="pricing-title">{{ __('pricing.plans') }}</span>
            <span class="pricing-subtitle">{{ __('pricing.subtitle') }}</span>
        </div>
        <div class="row pricing-options">
            <div class="col-lg-3 pricing-option">
                <span class="pricing-period">{{ __('pricing.monthly') }}</span>
                <div class="pricing-price">
                    <span class="pricing-amount">4,99</span><span class="pricing-coin">€</span>
                </div>
                <span class="pricing-details">
                    {{ __('pricing.monthly_desc') }}
                </span>
                <a href="{{ route('checkout', ['plan' => 'price_1RJYy5FMriy1hvBPZZdz8Rba']) }}" class="pricing-button btn btn-primary">
                   {{ __('pricing.sign_up') }}
                </a>
            </div>
            <div class="col-lg-4 pricing-option pricing-popular">
                <span class="popular">{{ __('pricing.popular') }}</span>
                <span class="pricing-period">{{ __('pricing.yearly') }}</span>
                <div class="pricing-price">
                    <span class="pricing-amount">29,99</span><span class="pricing-coin">€</span>
                </div>
                <span class="pricing-details">
                    {{ __('pricing.yearly_desc') }}
                </span>
                <a href="{{ route('checkout', ['plan' => 'price_1RJYy5FMriy1hvBPbjyEq6GY']) }}" class="pricing-button btn btn-primary">
                    {{ __('pricing.sign_up') }}
                </a>
            </div>
            <div class="col-lg-3 pricing-option">
                <span class="pricing-period">{{ __('pricing.lifetime') }}</span>
                <div class="pricing-price">
                    <span class="pricing-amount">99,99</span><span class="pricing-coin">€</span>
                </div>
                <span class="pricing-details">
                    {{ __('pricing.lifetime_desc') }}
                </span>
                <a href="{{ route('checkout', ['plan' => 'price_1RJYy5FMriy1hvBP9tJILxxj']) }}" class="pricing-button btn btn-primary">
                    {{ __('pricing.sign_up') }}
                </a>
            </div>
        </div>
    </div>
@endsection
