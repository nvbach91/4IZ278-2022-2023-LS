@extends('layouts.shop')

@php

    use App\Models\Product;
    use App\Http\Controllers\ProductController;
@endphp


@section('products')
    <div class="container-fluid col-8 d-flex flex-row flex-wrap mt-4 align-items-start gap-3 ">

        @foreach ($products as $product)
            <div class="card " style="width: 11rem;">
                <img src={{ asset('/assets/img/products/' . $product->thumbnail) }} class="card-img-top"
                    alt="{{ $product->name }} thumbnail">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h6 class="card-price">{{ $product->price }}$</h5>
                        @if ($product->stock > 0)
                            <p class="card-price text-success">In stock</p>
                        @endif
                        @if ($product->stock == 0)
                            <p class="card-price text-danger">Out of stock</p>
                        @endif
                        <a href="" class="btn btn-primary">Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
