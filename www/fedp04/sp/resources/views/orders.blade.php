@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection

@foreach($orders as $order)
                        <div class="col-md-2">
                            <a href="{{route('orders',$order->id)}}">
                                <h4 class="text-center btn btn-primary ">Order #{{$order->id}}</h4>
                            </a>
                            <p>{{$order->id}}</p>
                        </div>
                    @endforeach


@section('content')






@endsection
