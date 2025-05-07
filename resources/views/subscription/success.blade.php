@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="success-container">
            <h2 class="subscription-thanks">{{ __('pricing.thanks') }}</h2>

            <p class="subscription-details">{{ __('pricing.new_options') }}</p>

            @if (auth()->user()->subscription('prod_SE108n2SgYwi6u')->ends_at)
                <p class="subscription-details">{{ __('pricing.sub_ends') }}</p>
                <span class="subscription-ends">
                    {{ auth()->user()->subscription('prod_SE108n2SgYwi6u')->ends_at->format('d M Y') }}
                </span>
                <form method="POST" action="{{ route('subscription.resume') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary resume-button">{{ __('pricing.sub_resume') }}</button>
                </form>
            @else
                <span class="subscription-ends">
                    {{ __('pricing.sub_renews') }}
                </span>
                <button class="btn btn-danger subscription-cancel" type="button" data-bs-toggle="modal"
                    data-bs-target="#cancelSuscriptionModal">
                    {{ __('pricing.cancel_sub') }}
                </button>
                <div class="modal fade" id="cancelSuscriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <button type="button" class="btn-close create-deck-modal-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="modal-body">
                                {{ __('pricing.cancel_confirmation') }}
                                <form method="POST" action="{{ route('subscription.cancel') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        {{ __('pricing.cancel_sub') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
