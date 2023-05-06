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
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(is_array($cart) || is_object($cart))
                @foreach($cart as $id => $item) <!-- Update the loop to include the product id -->
                <tr>
                    <td>{{ isset($item['name']) ? $item['name'] : 'Unknown Product' }}</td>
                    <td>${{ isset($item['price']) ? $item['price'] : 0 }}</td>
                    <td>{{ isset($item['quantity']) ? $item['quantity'] : 0 }}</td>
                    <td>${{ isset($item['price']) && isset($item['quantity']) ? $item['price'] * $item['quantity'] : 0 }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-dark btn-sm">X</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
            <tr>
                <td colspan="4" class="text-end"><strong>Sum:</strong></td>
                <td>${{ number_format($totalSum, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        <a href="{{ route('cart.flush') }}" class="btn btn-outline-danger me-2">Flush Cart</a>
        <a href="/checkout" class="btn btn-primary" {{ $totalSum > 0 ? '' : 'disabled' }}>Proceed to Checkout</a>
    </div>
</div>
@endsection
