@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="container-fluid mt-10 mb-10">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card_product bg-light">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" src="{{ $product->img }}"
                                        width="350" /> </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <div class="col-mt-5 mb-5">{{ $product->description }}</div>
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">

                                </div>

                                <h5 class="text-uppercase">{{ $product->name }}</h5>
                                <div class="price d-flex flex-row align-items-center"> <span
                                        class="act-price">{{ $product->priceKc() }}</span>

                                </div>
                            </div>
                            <p class="about">Shop from a wide range of frogs. You can order your frog delivery via coureer
                                or you can pick it up yourself at our store. If you are willing to order inanimate product,
                                you can order its delivery via coureer/post or you can pick it up from our store as well.
                                FROGS CAN NOT BE DELIVERED VIA POST!!!</p>
                            <form action="/cart/add" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <input type="hidden" name="redirect" value="home">
                                <div class="cart mt-4 align-items-center"> <button type="submit"
                                        class="btn btn-danger text-uppercase mr-2 px-4" >Add to cart</button> <i
                                        class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
