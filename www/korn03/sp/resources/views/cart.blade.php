@extends('layouts.app');
@php
    use App\Models\Category;
    use App\Http\Controllers\CartController;

    $total_price = 0;
    $total_sale = 0;
@endphp



@section('content')
    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="h5">Shopping Bag</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (empty($cart))
                                    <h1>Nothing in cart!</h1>
                                @else
                                    @php
                                        $uniqueID = array_count_values($cart);
                                    @endphp
                                    @foreach ($products as $product)
                                        @if (in_array($product->id, $cart))
                                            @php
                                                $total_price +=$product->price * $uniqueID[$product->id];
                                                $total_sale +=$product->discount * $uniqueID[$product->id];
                                            @endphp
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('product', $product->id) }}"><img
                                                                src="/assets/img/products/{{ $product->thumbnail }}"
                                                                class="img-fluid rounded-3" style="width: 120px;"
                                                                alt="..."></a>
                                                        <div class="flex-column ms-4">
                                                            <p class="mb-2">{{ $product->brand }}</p>
                                                            <p class="mb-0">{{ $product->name }}</p>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">
                                                        {{ Category::find($product->category_id)->name }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-row">



                                                        <form method="POST" action="{{ route('remove_from_cart') }}">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <input id="quantity" name="quantity" min="0"
                                                                name="quantity" value="1" type="hidden"
                                                                class="form-control form-control-sm" style="width: 50px;" />
                                                            <button class="btn px-2" type="submit"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                -
                                                            </button>
                                                        </form>
                                                        <input id="quantity" name="quantity" min="0" name="quantity"
                                                            value="{{ $uniqueID[$product->id] }}" type="number"
                                                            class="form-control form-control-sm" style="width: 50px;"
                                                            disabled />

                                                        <form method="POST" action="{{ route('add_to_cart') }}">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $product->id }}">
                                                            <input id="quantity" name="quantity" min="0"
                                                                name="quantity" value="1" type="hidden"
                                                                class="form-control form-control-sm" style="width: 50px;" />
                                                            <button class="btn px-2" type="submit"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                +
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">
                                                        {{ $product->price * $uniqueID[$product->id] }}$</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">
                                                        -{{ $product->discount * $uniqueID[$product->id] }}$</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">
                                                        {{ $product->price * $uniqueID[$product->id] - $product->discount * $uniqueID[$product->id] }}$
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif



                            </tbody>
                        </table>
                    </div>

                    <form method="POST"  action="{{ route('make_an_order') }}">
                        @csrf
                        <input name="total_price" value="{{$total_price}}" type="hidden"/>
                        <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                            <div class="card-body p-4">
                                <div class="p-4">
                                    <h3>Payment</h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                                        <form>
                                            <div class="d-flex flex-row pb-3">
                                                <div class="d-flex align-items-center pe-2">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="radioNoLabel1v" value="cash" aria-label="..." checked />
                                                </div>
                                                <div class="rounded border w-100 p-3">
                                                    <p class="d-flex align-items-center mb-0">
                                                        Cash on delivery
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row pb-3">
                                                <div class="d-flex align-items-center pe-2">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="radioNoLabel2v" value="card" aria-label="..." />
                                                </div>
                                                <div class="rounded border w-100 p-3">
                                                    <p class="d-flex align-items-center mb-0">
                                                        Card
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!--
                                    <div class="col-md-6 col-lg-4 col-xl-6">
                                        <div class="row">
                                            <div class="col-12 col-xl-6">
                                                <div class="form-outline mb-4 mb-xl-5">
                                                    <input type="text" id="typeName"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="John Smith" />
                                                    <label class="form-label" for="typeName">Name on card</label>
                                                </div>

                                                <div class="form-outline mb-4 mb-xl-5">
                                                    <input type="text" id="typeExp"
                                                        class="form-control form-control-lg" placeholder="MM/YY"
                                                        size="7" id="exp" minlength="7" maxlength="7" />
                                                    <label class="form-label" for="typeExp">Expiration</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-xl-6">
                                                <div class="form-outline mb-4 mb-xl-5">
                                                    <input type="text" id="typeText"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="1111 2222 3333 4444" minlength="19"
                                                        maxlength="19" />
                                                    <label class="form-label" for="typeText">Card Number</label>
                                                </div>

                                                <div class="form-outline mb-4 mb-xl-5">
                                                    <input type="password" id="typeText"
                                                        class="form-control form-control-lg"
                                                        placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3"
                                                        maxlength="3" />
                                                    <label class="form-label" for="typeText">Cvv</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     -->
                                    <div class="col-lg-4 col-xl-3">
                                        <div class="d-flex justify-content-between" style="font-weight: 500;">
                                            <p class="mb-2">Subtotal</p>
                                            <p class="mb-2">{{ $total_price }}$</p>
                                        </div>

                                        <div class="d-flex justify-content-between" style="font-weight: 500;">
                                            <p class="mb-0">Discount</p>
                                            <p class="mb-0">-{{ $total_sale }}$</p>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                            <p class="mb-2">Total</p>
                                            <p class="mb-2">{{ $total_price - $total_sale }}$</p>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                                            <div class="d-flex justify-content-between">
                                                <span>Checkout</span>
                                            </div>
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
