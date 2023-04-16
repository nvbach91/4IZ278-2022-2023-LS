@extends('layouts.base')

@section('title', 'Eshop')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->images[0]->url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                        <a href="#" class="btn btn-primary">Buy</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection



@push('scripts')
    <script src="{{ asset('js/checkout.js') }}"></script>
@endpush