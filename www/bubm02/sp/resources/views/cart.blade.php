@extends('layouts.app')

@section('config')
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endsection

@section('content')
<section class="h-100 h-custom" >
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card shopping-cart" style="border-radius: 15px;">
                    <div class="card-body text-black">

                        <div class="row">
                            <div class="col-lg-6 px-5 py-4">

                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>

                                @foreach($items as $item)
                                    @php
                                        $item->price = $item->price * $cart[$item->id];
                                        $item->discount_price = $item->discount_price * $cart[$item->id];
                                    @endphp
                                    <div class="d-flex align-items-center m-1">
                                        <form id="form-add-{{$item->id}}" method="post" action="{{route('cart.add')}}">
                                            @csrf
                                            <input type="hidden" value="cart" name="redirect">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        </form>
                                        <form id="form-minus-{{$item->id}}" method="post" action="{{route('cart.subtract')}}">
                                            @csrf
                                            <input type="hidden" value="cart" name="redirect">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        </form>
                                        <form id="form-remove-{{$item->id}}" method="post" action="{{route('cart.remove')}}">
                                            @csrf
                                            <input type="hidden" value="cart" name="redirect">
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        </form>
                                        <div class="flex-shrink-0 m-5">
                                            <img src="{{$item->image}}" style="max-width: 150px; max-height: 250px" alt="Generic placeholder image">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <a href="javascript:{}" onclick="document.getElementById('form-remove-{{$item->id}}').submit();"
                                               class="float-end text-black">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            <h5 class="text-primary">{{$item->name}}</h5>
                                            <h6 style="color: #9e9e9e;">Color: white</h6>
                                            <div class="d-flex align-items-center">

                                                @if($item->discount_price > 0)
                                                    <p class="text-decoration-line-through mb-0 me-2 pe-1">{{$item->priceKc()}}</p>
                                                    <p class="fw-bold mb-0 me-2 pe-1">{{$item->discountPriceKc()}}</p>
                                                @else
                                                    <p class="fw-bold mb-0 me-5 pe-4">{{$item->priceKc()}}</p>
                                                @endif
                                                <div class="def-number-input number-input">
                                                    <button onclick="document.getElementById('form-minus-{{$item->id}}').submit();"
                                                            class="minus"></button>
                                                    <input class="quantity fw-bold text-black" min="0" name="quantity" value="{{$cart[$item->id]}}"
                                                           type="number" oninput="" readonly>
                                                    <button onclick="document.getElementById('form-add-{{$item->id}}').submit();"
                                                            class="plus"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">

                                <div class="d-flex justify-content-between px-x">
                                    <p class="fw-bold">Discount:</p>
                                    <p class="fw-bold">{{App\Models\Item::sumDiscountKc($items)}}</p>
                                </div>
                                <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                    <h5 class="fw-bold mb-0">Total:</h5>
                                    <h5 class="fw-bold mb-0">{{App\Models\Item::sumTotalKc($items)}}</h5>
                                </div>

                            </div>
                            <div class="col-lg-6 px-5 py-4">

                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment</h3>

                                <form class="mb-5">

                                    <div class="form-outline mb-5">
                                        <input type="text" id="typeText" class="form-control form-control-lg" size="17"
                                               value="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                        <label class="form-label" for="typeText">Card Number</label>
                                    </div>

                                    <div class="form-outline mb-5">
                                        <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                               value="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" />
                                        <label class="form-label" for="typeName">Name on card</label>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <div class="form-outline">
                                                <input type="text" id="typeExp" class="form-control form-control-lg" value="01/22"
                                                       size="7" id="exp" minlength="7" maxlength="7" />
                                                <label class="form-label" for="typeExp">Expiration</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-5">
                                            <div class="form-outline">
                                                <input type="password" id="typeText" class="form-control form-control-lg"
                                                       value="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                <label class="form-label" for="typeText">Cvv</label>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mb-5">Lorem ipsum dolor sit amet consectetur, adipisicing elit <a
                                            href="#!">obcaecati sapiente</a>.</p>

                                    <button type="button" class="btn btn-primary btn-block btn-lg">Buy now</button>

                                    <h5 class="fw-bold mb-5" style="position: absolute; bottom: 0;">
                                        <a href="{{route('index')}}"><i class="fa fa-angle-left me-2"></i>Back to shopping</a>
                                    </h5>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
