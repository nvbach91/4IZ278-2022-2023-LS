@extends('layouts.app')

@section('config')
    <link rel="stylesheet" href="{{ asset('frontend/css/product-list.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">

            {{--                <div class="card-body">--}}
            {{--                    @if (session('status'))--}}
            {{--                        <div class="alert alert-success" role="alert">--}}
            {{--                            {{ session('status') }}--}}
            {{--                        </div>--}}
            {{--                    @endif--}}

            {{--                    {{ __('You are logged in!') }}--}}
            {{--                    @foreach ($categories as $category)--}}
            {{--                        <ul>--}}
            {{--                            <li>Category id: {{$category->id}}, Category name: {{$category->name}}</li>--}}
            {{--                        </ul>--}}
            {{--                    @endforeach--}}
            {{--                </div>--}}
            <div class="container rounded bg-white mt-5 mb-5 card">
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                                <strong>{{session()->get('error')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                                <strong>{{session()->get('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px"
                                 src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                            <span class="font-weight-bold">{{$user->first_name}}</span>
                            <span>{{$user->last_name}}</span>
                            <span class="text-black-50">{{$user->email}}</span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            @if($errors->profile->any())
                                @foreach ($errors->profile->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <form method="post" action="{{route('profile.update')}}">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels" for="first-name">Name</label>
                                        <input id="first-name" name="first_name" type="text" class="form-control"
                                               placeholder="First name" value="{{$user->first_name}}" pattern="\w+">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels" for="last-name">Surname</label>
                                        <input id="last-name" name="last_name" type="text" class="form-control"
                                               placeholder="Last name" value="{{$user->last_name}}" pattern="\w+">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="phone">Phone Number</label>
                                    <input id="phone" name="phone" type="text" class="form-control"
                                           placeholder="Enter phone number" value="{{$user->phone}}" pattern="\+\d+">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="email">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                           placeholder="Enter email"
                                           value="{{$user->email}}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="isic-number">Isic Number</label>
                                    <input id="isic-number" name="isic-number"
                                           type="text" class="form-control" placeholder="enter email id"
                                           value="{{$user->isic_number}}">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Save Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                                @if($errors->adress->any())
                                    @foreach ($errors->adress->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <h4>Addresses</h4>
                                </div>
                                @foreach($adresses as $adress)
                                    <form id="form-adress-{{$adress->id}}" method="post"
                                          action="{{route('adress.remove')}}">
                                        @csrf
                                        <p>{{$adress->adress_1 . ', ' . $adress->adress_2 . ', ' . $adress->zip_code . ', ' . $adress->city . ', ' . $adress->country}}
                                            <a href="javascript:{}"
                                               onclick="document.getElementById('form-adress-{{$adress->id}}').submit();"
                                               class="float-end text-black">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </p>
                                        <input type="hidden" name="id" value="{{$adress->id}}">
                                    </form>
                                @endforeach
                            <form method="post" action="{{route('adress.add')}}">
                                @csrf
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="adress1">Address Line 1</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 1"
                                           value="" id="adress1" name="adress1" pattern="\w+">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="adress2">Address Line 2</label>
                                    <input type="text" class="form-control" placeholder="Enter address line 2"
                                           value="" id="adress2" name="adress2" pattern="\w+">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="zip">Zip Code</label>
                                    <input id="zip" name="zip" type="text" class="form-control"
                                           placeholder="Zip code" pattern="\d{5}" value="">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels" for="country">Country</label>
                                        <input type="text" class="form-control" placeholder="country"
                                               value="" id="country" name="country" pattern="\w+">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels" for="city">City</label>
                                        <input id="city" name="city" type="text" class="form-control" value=""
                                               placeholder="City" pattern="\w+">
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Add adress</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container rounded bg-white mt-5 mb-5 card">
                <div class="p-2 py-2 pt-4 d-flex justify-content-center align-items-center">
                    <h2 class="text-center">Orders</h2>
                </div>
                    <div class="row mb-3">
                            @foreach($orders as $order)

                            <div class="col-md-2">
                        <a href="{{route('order.show',$order->id)}}" ><button class="text-center btn btn-primary ">Order #{{$order->id}}</button></a>
{{--                        <div class="col-md-12">--}}
{{--                            <div class="p-3 py-3">--}}
{{--                                <div class="d-flex justify-content-between align-items-center experience">--}}
{{--                                    <h5 class="mt-3">Order #{{$order->id}}</h5>--}}
{{--                                    @php--}}
{{--                                        $date = new DateTime($order->created_at->toDateTimeString());--}}
{{--                                        $timezone = new DateTimeZone($user->timezone);--}}
{{--                                        $offset = $timezone->getOffset($date);--}}
{{--                                        $timestamp = strtotime($date->format('Y-m-d H:i:s')) + $offset;--}}
{{--                                        $zonedDate = date("Y-m-d H:i:s", $timestamp);--}}
{{--                                    @endphp--}}
{{--                                    <span class="float-end"><i class="fa fa-calendar"></i> {{$zonedDate}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label class="labels">Address</label>--}}
{{--                                    <p>{{$order->adress_1 . ', ' . $order->adress_2 . ', ' . $order->zip_code . ', ' . $order->city . ', ' . $order->country}}</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label class="labels">Total Price</label>--}}
{{--                                    <p>{{$order->totalPrice()}} Kč</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12 mt-3">--}}
{{--                                    <label class="labels">Status</label>--}}
{{--                                    <p>{{$order->status}}</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12 mt-3 row">--}}
{{--                                    <label class="label">Products</label>--}}
{{--                                    @foreach($order->orderItems() as $orderItem)--}}
{{--                                        @php($item = \App\Models\Item::find($orderItem->item_id))--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <img src="{{$item->image}}" style="max-width: 150px; max-height: 250px">--}}
{{--                                            <p>Name: {{$item->name}}</p>--}}
{{--                                            <p>Price: {{$orderItem->old_price}} Kč</p>--}}
{{--                                            <p>Quantity: {{$orderItem->quantity}}</p>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                            </div>

                            @endforeach
                    </div>
            </div>
        </div>
    </div>
@endsection
