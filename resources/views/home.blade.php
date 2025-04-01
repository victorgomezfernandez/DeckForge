@extends('layouts.app')

@section('content')
<div class="container">
    HOME PAGE
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('HOME') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('HOME PAGE') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
