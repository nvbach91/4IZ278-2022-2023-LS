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
                            background-size: contain;
                            transition: all 0.3s;
                        ">
                            <ul>
                                <li>
                                    <form id="form{{$item->id}}" method="post" action="{{route('cart.add')}}">
                                        @csrf
                                        <input type="hidden" value="index" name="redirect">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                    </form>
                                    <a href="javascript:{}" onclick="document.getElementById('form{{$item->id}}').submit();"><i class="fa fa-shopping-cart"></i></a>
                                </li>
{{--                                <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
{{--                                <li><a href="#"><i class="fa fa-plus"></i></a></li>--}}
                                <li><a href="{{route('product', $item->id)}}"><i class="fa fa-expand"></i></a></li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{$item->name}}</h3>
                            @if($item->discount_price > 0)
                                <h4 class="product-old-price">{{$item->priceKc()}}</h4>
                                <h4 class="product-price">{{$item->discountPriceKc()}}</h4>
                            @else
                                <h4 class="product-price">{{$item->priceKc()}}</h4>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $items->links() !!}
    </section>
@endsection
