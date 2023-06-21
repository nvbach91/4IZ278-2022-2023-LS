@extends('product')
@section('relatedProducts')
@php

use App\Models\Product;
use App\Http\Controllers\ProductController;
@endphp

@foreach ($products as $product)
<div class="card h-100">
    <!-- Sale badge-->
    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
    </div>
    <!-- Product image-->
    <img class="card-img-top" src="/assets/img/products/{{$product->thumbnail}}" alt="{{$product->name}} photo">
    <!-- Product details-->
    <div class="card-body p-4">
        <div class="text-center">
            <!-- Product name-->
            <h5 class="fw-bolder">{{$product->brand}} {{$product->name}}</h5>
            <!-- Product reviews-->
            <!-- Product price-->
            @if($product->discount>0)
             <span class="text-muted text-decoration-line-through">{{$product->price}}$</span>
            @endif

            {{$product->price - $product->discount}}$
        </div>
    </div>
    <!-- Product actions-->
    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View</a></div>
    </div>
</div>
@endforeach
@endsection
