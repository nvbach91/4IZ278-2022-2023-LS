@extends('layouts.app')

@section('content')

    <section class="py-5">
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
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6 product-image-wrap d-flex justify-content-center">
                    <img class="card-img-top mb-5 mb-md-0 product-image" src="{{$item->image}}" alt="..." />
                </div>
                <div class="col-md-6">
                    @php
                        $codeLength = 8;
                        $itemCodeLength = strlen($item->id);
                        if ($codeLength - $itemCodeLength > 0) {
                            $code = str_repeat('0', $codeLength - $itemCodeLength) . $item->id;
                        } else {
                            $code = $item->id;
                        }
                    @endphp
                    <div class="small mb-1">CODE: HH {{$code}}</div>
                    <h1 class="display-5 fw-bolder">{{$item->name}}</h1>
                    <div class="fs-5 mb-5">
                        @if($item->discount_price > 0)
                            <span class="text-decoration-line-through">${{$item->price}}</span>
                            <span>{{$item->discountPriceKc()}}</span>
                        @else
                            <span>{{$item->priceKc()}}</span>
                        @endif
                    </div>
                    <p class="lead">{{$item->description}}</p>
                    @if($item->stock > 0)
                        <h5 class="product-stock text-success">In stock</h5>
                    @else
                        <h5 class="product-stock text-danger">Out of stock</h5>
                    @endif
                    <div class="d-flex">
                        <form id="form{{$item->id}}" method="post" action="{{route('cart.add')}}">
                            @csrf
                            <input class="form-control text-center me-3" name="quantity" type="number" value="1" style="max-width: 3rem" />
                            <input type="hidden" value="index" name="redirect">
                            <input type="hidden" name="id" value="{{$item->id}}">
                        </form>
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" href="javascript:{}" onclick="document.getElementById('form{{$item->id}}').submit();">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($relatedItems as $item)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        @if($item->discount_price > 0)
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top flex-shrink-0 product-image" src="{{$item->image}}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$item->name}}</h5>
{{--                                <!-- Product reviews-->--}}
{{--                                <div class="d-flex justify-content-center small text-warning mb-2">--}}
{{--                                    <div class="bi-star-fill"></div>--}}
{{--                                    <div class="bi-star-fill"></div>--}}
{{--                                    <div class="bi-star-fill"></div>--}}
{{--                                    <div class="bi-star-fill"></div>--}}
{{--                                    <div class="bi-star-fill"></div>--}}
{{--                                </div>--}}
                                <!-- Product price-->
                                @if($item->discount_price > 0)
                                    <span class="text-muted text-decoration-line-through">{{$item->priceKc()}}</span>
                                    {{$item->discountPriceKc()}}
                                @else
                                    {{$item->priceKc()}}
                                @endif
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('product', $item->id)}}">Check out</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
