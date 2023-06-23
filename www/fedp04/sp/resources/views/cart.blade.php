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
                            @php($sum = 0)
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

                                                        <form method="post" action="{{ route('cart.minus') }}">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <button class="btn px-2" type="submit"
                                                                onclick="this.parentNode.querySelector('input[id=quantity]').stepDown()">
                                                                <div>-</div>
                                                            </button>
                                                        </form>
                                                        <input id="quantity" type=""
                                                            value="{{ $cart[$product->id] }}"
                                                            class="form-control quantity-input">

                                                        <form method="post" action="{{ route('cart.add') }}">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <button class="btn px-2" type="submit"
                                                                onclick="this.parentNode.querySelector('input[id=quantity]').stepUp()">
                                                                <div>+</div>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        @php($sum += $product->price * $cart[$product->id]) )
                                                        <span>{{ \App\Models\Product::toKc($product->price * $cart[$product->id]) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="col-lg-5">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                <div class="card bg-primary text-white rounded-3">

                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Card details</h5>
                                        </div>

                                        <form class="mt-4" method="POST" action="{{ route('make.order') }}">
                                            @csrf
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeName" class="form-control form-control-lg"
                                                    siez="17" placeholder="Cardholder's Name" />
                                                <label class="form-label" for="typeName">Cardholder's Name</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="text"  pattern="\d{16}" id="typeText" class="form-control form-control-lg"
                                                    placeholder="1234 5678 9012 3457" minlength="16" maxlength="16" data-pattern-mismatch="The credit card number must have 16 digits"
                                                    name="card" />
                                                <label class="form-label" for="typeText">Card Number</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="typeExp"
                                                            class="form-control form-control-lg" pattern="\d{2}/\d{2}"
                                                                 placeholder="MM/YY"  id="expire" name="expire" minlength="4"
                                                            maxlength="6" />
                                                        <label class="form-label" for="typeExp">Expiration</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="password" id="typeText"
                                                            class="form-control form-control-lg"
                                                            placeholder="&#9679;&#9679;&#9679;" size="1"
                                                            minlength="3" maxlength="3" />
                                                        <label class="form-label" for="typeText">Cvv</label>
                                                    </div>
                                                </div>
                                            </div>



                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <p class="mb-2">{{\App\Models\Product::toKc($sum)}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Shipping</p>
                                                <p class="mb-2">{{\App\Models\Product::toKc(100)}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total(Incl. taxes)</p>
                                                <p class="mb-2">{{\App\Models\Product::toKc($sum + 100)}}</p>
                                            </div>

                                            <button type="submit" class="btn btn-info btn-block btn-lg">
                                                <div class="d-flex justify-content-between">
                                                    <span>{{\App\Models\Product::toKc($sum + 100)}}</span>
                                                    <span> Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </button>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    </div>
    </section>
@endsection
