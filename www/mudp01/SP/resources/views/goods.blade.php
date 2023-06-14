@extends('layout')
@section('content')
@isset($message)
    <div id="message" class="message">
        <p>{{$message}}</p>
    </div>
@endisset
<div class="goods-display">
@php
    $productType = null;
@endphp
@foreach ($goods as $good)
@if ($good->product_type != $productType)
<div class="goods-category-holder">
    <label class="goods-category-label">
        {{$good->product_type}}
    </label>
</div>
@php
    $productType = $good->product_type;
@endphp
@endif


    <div class="goods-product-holder">
        <div class="goods-product-item">
            <img class="goods-product-item-img" src="{{$good->img}}" alt="{{$good->alt}}">
            <p class="goods-product-item-name">{{$good->name}}</p>
            <p class="goods-product-item-description">{{$good->description}}</p>
            <div class="goods-product-item-priceHolder">
                <label class="goods-product-item-price">{{$good->price}} $</label>
                <form method="POST">
                    @csrf
                    <input hidden value="{{$good->id}}" name="item_id">
                <button type="submit" class="goods-product-item-add">Add to cart</button>
                <input type="number" name="quantity" value="1" min="1" max="{{$good->available}}">
                <label>In stock: {{$good->available}}</label>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection