@extends('layout')
@section('content')
<div class="homepage-div">
<h1>Orders</h1>
@if (count($orders)>0)
@foreach ($orders as $order)
<div>
    <h2>Order ID: {{$order->id}}</h2>
<p>Created: {{$order->created}}</p>
<p>State: {{$order->state}}</p>
</div>
@endforeach
@else
No orders found.    
@endif
</div>
@endsection