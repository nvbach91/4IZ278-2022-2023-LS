@extends('layout')
@section('content')
<h1 class="cart-heading">Cart contents</h1>
@if (!is_null(session('cart')) && !empty($items))
@php
$totalPrice = 0;
@endphp
<form method="POST" id="remove-item">@csrf</form>
<form method="POST">
    @csrf
    @foreach ($items as $item)
    <div class="cart-item">
    <input hidden name="id[]" value="{{$item['id']}}">
    <label>Item:</label><input class="cart-item-name" readonly name="name[]" value="{{$item['name']}}">
    <input readonly name="priceEach[]" value="{{$item['price']}} $">
    <label> each</label>
        @if ($item['quantity']>1)
        <input type="number" min="1" max="{{$item['stock']}}" name="quantity[]" value="{{$item['quantity']}}">
        <label>pieces</label>
        <button form="remove-item" name="remove_id" value="{{$item['id']}}" type="submit">Remove item</button>
        @else
        <input type="number" min="1" max="{{$item['stock']}}" name="quantity[]" value="{{$item['quantity']}}">
        <label>piece</label>
        <button form="remove-item" name="remove_id" value="{{$item['id']}}" type="submit">Remove item</button>
        @endif

    </div>
        @php
            $totalPrice += $item['price'] * $item['quantity'];
        @endphp
    @endforeach
    <div class="cart-item-total">
    <label>Total price: </label>
    <input readonly name="totalPrice" value="{{$totalPrice}} $">
    </div>
    <div class="cart-item-confirm">
    <button name="confirm-order" value="true" type="submit">Place order</button>
    </div>
</form>
    
@else
    The cart is empty

@endif
<script src="{{ asset('js/cart.js') }}"></script>
@endsection
