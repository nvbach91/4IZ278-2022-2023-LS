@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="shopping-cart dark">
        <div class="container">
            <div class="block-heading">
                <h2>Shopping Cart</h2>

            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items">
                            @foreach ($products as $product)
                                <div class="product">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="img-fluid mx-auto d-block image" src="{{ $product->img }}">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="info">
                                                <div class="row mt-5">
                                                    <div class="col-md-5 product-name">
                                                        <div class="product-name">
                                                            <a href="#">{{ $product->name }}</a>
                                                            <div class="product-info">
                                                                <div>Description: {{ $product->description }}
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 quantity">
                                                        <label for="quantity">Quantity:</label>

                                                        <form method="post" action="{{route('cart.minus')}}">
                                                            @csrf
                                                            <input type="hidden" value="cart" name="redirect">
                                                            <input type="hidden" name="id" value="{{$product->id}}">
                                                            <button class="btn px-2"  type="submit"
                                                                onclick="this.parentNode.querySelector('input[id=quantity]').stepDown()">
                                                                <div>-</div>
                                                            </button>
                                                        </form>
                                                        <input id="quantity" type="" value="{{$cart[$product->id]}}"
                                                            class="form-control quantity-input">

                                                        <form method="post" action="{{route('cart.add')}}">
                                                            @csrf
                                                            <input type="hidden" value="cart" name="redirect">
                                                            <input type="hidden" name="id" value="{{$product->id}}">
                                                            <button class="btn px-2" type="submit"
                                                                onclick="this.parentNode.querySelector('input[id=quantity]').stepUp()">
                                                                <div>+</div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        <span>{{\App\Models\Product::toKc($product->price * $cart[$product->id])}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                            <h3>Summary</h3>
                            <div class="summary-item"><span class="text"></span>{{\App\Models\Product::sumKc($cart)}}<span class="price"></span>
                            </div>
                            <h5>+ shipping</h5>
                            <div class="shipping"><span class= "text"></span>{{100}} {{"Kč"}}<span class="price"></span></div>

                            <button type="button" class="btn btn-primary btn-lg btn-block">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
