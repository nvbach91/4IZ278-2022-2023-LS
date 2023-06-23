@extends('layouts.app')

@section('config')
    <link rel="stylesheet" href="{{ asset('frontend/css/product-list.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="container rounded bg-white mt-5 mb-5 card">
                <div class="p-2 py-2 pt-4 d-flex justify-content-center align-items-center">
                    <h2 class="text-center">Order #{{$order->id}}</h2>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <a href="{{route('order.admin.deny', $order->id)}}" class="btn btn-danger">Deny</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('order.admin.approve', $order->id)}}" class="btn btn-primary">Approve</a>
                    </div>
                    <div class="col-md-12">
                        <div class="p-3 py-3">
                            <div class="d-flex justify-content-between align-items-center experience">
                                <h5 class="mt-3">Order #{{$order->id}} details</h5>
                                @php
                                    $date = new DateTime($order->created_at->toDateTimeString());
                                    $timezone = new DateTimeZone($user->timezone);
                                    $offset = $timezone->getOffset($date);
                                    $timestamp = strtotime($date->format('Y-m-d H:i:s')) + $offset;
                                    $zonedDate = date("Y-m-d H:i:s", $timestamp);
                                @endphp
                                <span class="float-end"><i class="fa fa-calendar"></i> {{$zonedDate}}</span>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="labels">Address</label>
                                <p>{{$order->adress_1 . ', ' . $order->adress_2 . ', ' . $order->zip_code . ', ' . $order->city . ', ' . $order->country}}</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="labels">Total Price</label>
                                <p>{{$order->totalPrice()}} Kč</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="labels">Status</label>
                                <p>{{$order->status}}</p>
                            </div>
                            <div class="col-md-12 mt-3 row">
                                <label class="label">Products</label>
                                @foreach($order->orderItems() as $orderItem)
                                    @php($item = \App\Models\Item::find($orderItem->item_id))
                                    <div class="col-md-4">
                                        <img src="{{$item->image}}" style="max-width: 150px; max-height: 250px">
                                        <p>Name: {{$item->name}}</p>
                                        <p>Price: {{$orderItem->old_price}} Kč</p>
                                        <p>Quantity: {{$orderItem->quantity}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
