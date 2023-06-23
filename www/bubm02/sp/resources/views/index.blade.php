@extends('layouts.app')

@section('config')
    <link rel="stylesheet" href="{{ asset('frontend/css/product-list.css') }}">
@endsection

@section('content')

    <section class="section-products">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                        <strong>{{session()->get('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                        <strong>{{session()->get('error')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif($errors->any('errors'))
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                            <strong>{{$error}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
            </div>
            @if(isset($categoryName))
                <h2 class="mb-5">{{$categoryName}}</h2>
            @endif
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
                                    <a href="javascript:{}"
                                       onclick="document.getElementById('form{{$item->id}}').submit();"><i
                                            class="fa fa-shopping-cart"></i></a>
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
                            @if($item->stock > 0)
                                <h5 class="product-stock text-success">In stock</h5>
                            @else
                                <h5 class="product-stock text-danger">Out of stock</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $items->links() !!}
    </section>
@endsection
