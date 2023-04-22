@extends('layouts.base')

@section('title', 'Eshop')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            @if(session('status'))
                <div class="alert alert-success text-center custom-alert" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->images[0]->url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">${{ $product->price }}</p>
                        <form action="{{ route('cart.add') }}" method="post" class="d-flex">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" min="1" value="1" name="quantity" class="form-control me-2">
                            <button type="submit" class="btn btn-outline-dark">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div> -->
</div>
@endsection
