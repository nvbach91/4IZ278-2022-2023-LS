@extends('layouts.shop')

@php use App\Models\Product; @endphp

@section('products')
<div class="container-fluid col-8 d-flex flex-row flex-wrap mt-4 align-items-start gap-3 ">

@foreach (Product::all() as $product)
<div class="card " style="width: 11rem;">
    <a href="{{ route('product', $product->id,)}}"><img src="/assets/img/products/{{$product->thumbnail}}" class="card-img-top" alt="{{$product->name}} thumbnail"></a>
    <div class="card-body">
      <h5 class="card-title">{{$product->name}}</h5>
      <h6 class="card-price">{{$product->price}}$</h5>
        @if ($product->stock > 0)
        <p class="card-price text-success">In stock</p>
        @endif
        @if ($product->stock == 0)
        <p class="card-price text-danger">Out of stock</p>
        @endif
      <a href="{{ route('product', $product->id,)}}" class="btn btn-primary">Details</a>

    </div>
  </div>
@endforeach
</div>
@endsection
