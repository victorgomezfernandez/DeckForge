@extends('layouts.app')
@section('content')
    <div class="container">
        @if (auth()->user()->subscribed('prod_SE108n2SgYwi6u'))
        <div class="row">
            CONGRATULATIONS you are sus
        </div>
        @endif
    </div>
@endsection
