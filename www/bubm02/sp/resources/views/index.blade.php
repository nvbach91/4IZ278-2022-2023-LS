@extends('layouts.app')

@section('config')
    <link rel="stylesheet" href="{{ asset('frontend/css/product-list.css') }}">
@endsection

@section('content')

    <section class="section-products">
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-1" class="single-product">
                        <div class="part-1" style="
                            background: url({{$item->image}}) no-repeat center;
                            background-size: cover;
                            transition: all 0.3s;
                        ">
                            <ul>
                                <li><a href="/product/{{$item->id}}"><i class="fa fa-shopping-cart"></i></a></li>
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-expand"></i></a></li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{$item->name}}</h3>
                            @if($item->discount_price > 0)
                                <h4 class="product-old-price">${{$item->price}}</h4>
                                <h4 class="product-price">${{$item->discount_price}}</h4>
                            @else
                                <h4 class="product-price">${{$item->price}}</h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
