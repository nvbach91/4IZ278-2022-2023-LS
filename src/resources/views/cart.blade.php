@extends('layouts.base')

@section('title', 'Cart')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Your Cart</h1>
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ isset($item['name']) ? $item['name'] : 'Unknown Product' }}</td>
                <td>${{ isset($item['price']) ? $item['price'] : 0 }}</td>
                <td>{{ isset($item['quantity']) ? $item['quantity'] : 0 }}</td>
                <td>${{ isset($item['price']) && isset($item['quantity']) ? $item['price'] * $item['quantity'] : 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <a href="{{ route('cart.flush') }}" class="btn btn-danger me-2">Flush Cart</a>
        <a href="/checkout" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</div>
@endsection
