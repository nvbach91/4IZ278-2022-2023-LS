@extends('layouts.base')

@section('title', 'Order Success')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success text-center custom-alert" role="alert">
                Your order has been successfully placed!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <h2>Thank you for your purchase!</h2>
            <p>We appreciate your business, and we'll process your order shortly.</p>
            <a href="{{ route('store') }}" class="btn btn-outline-dark">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection
