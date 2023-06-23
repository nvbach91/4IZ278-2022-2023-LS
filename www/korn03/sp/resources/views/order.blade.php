@extends('layouts.app');
@php
    use App\Models\Category;
    use App\Models\Product;

    $total_price = 0;
@endphp

@section('content')
    <div class="card" style="border-radius: 10px;">
        <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Thanks for your order, {{ $user->name }}!</h5>
        </div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Receipt</p>
                <p class="small text-muted mb-0">Receipt Voucher : {{$order->id}}</p>
            </div>
            @foreach ($order_products as $order_product)
                @php
                    $product = Product::find($order_product->product_id);
                    $total_price = $total_price + $order_product->price_actual - $order_product->discount_actual;
                @endphp
                <div class="card shadow-0 border mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src={{ asset('/assets/img/products/' . $product->thumbnail) }} class="img-fluid"
                                    alt="{{ $product->name }} picture">
                            </div>
                            <div class="col-md-2 text-center d-flex flex-column justify-content-center align-items-center">
                                <p class="text-muted mb-0">{{ $product->brand }} {{ $product->name }}</p>
                                <p class="text-muted mb-0">{{ $product->code }}</p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small"></p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Qty: {{ $order_product->amount }}</p>
                            </div>
                            <div class="col-md-2 text-center d-flex flex-column justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Price:
                                    {{ $order_product->price_actual}}$</p>
                                <p class="text-muted mb-0 small">Sale:
                                    -{{ $order_product->discount_actual}}$</p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Total price:
                                    {{ ($order_product->price_actual * $order_product->amount) - ($order_product->discount_actual * $order_product->amount)}}$
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            @endforeach

            <div class="d-flex justify-content-between pt-2">
                <p class="fw-bold mb-0">Order Details</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">Total:</span>{{ $total_price }}$</p>
            </div>

            <div class="d-flex justify-content-between pt-2">
                <p class="text-muted mb-0">Invoice Number : {{ $order->id }}</p>
                <p class="text-muted mb-0"><span class="fw-bold me-4">Status:</span>{{ $order->status }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <p class="text-muted mb-0">Invoice Date : {{ $order->created_at }}</p>
            </div>
        </div>
    </div>
@endsection
