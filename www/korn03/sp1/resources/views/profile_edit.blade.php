@extends('layouts.app');
@php
    use App\Models\Category;
@endphp

@section('content')

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center"> <img
                                    src="https://eu.ui-avatars.com/api/?name={{ $user->name }}+{{ $user->surname }}"
                                    alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>{{ $user->name }} {{ $user->surname }}</h4>
                                    <p class="text-secondary mb-1">{{ $user->is_admin == 1 ? 'Administrator' : 'Customer' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Info-->
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST" action="{{route('profile_edit_submit')}}">
                                @csrf


                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">First Name</h6>

                                    </div>
                                    <div class="col">
                                        <input type="name" class="form-control " id="name" name="name"
                                            aria-describedby="name" value="{{ $user->name }}" required>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Surname</h6>

                                    </div>
                                    <div class="col">
                                        <input type="surname" class="form-control " id="surname" name="surname"
                                            aria-describedby="surname" value="{{ $user->surname }}" required>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Email</h6>

                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control " id="email" name="email"
                                            aria-describedby="email" value="{{ $user->email }}" required>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h6 class="mb-0">Phone</h6>

                                    </div>
                                    <div class="col">
                                        <input type="phone" class="form-control " id="phone" name="phone"
                                            aria-describedby="phone" value="{{ $user->phone }}">
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="sumbit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--Addresses-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3>Addresses:</h3>
                            @if (empty($addresses))
                                <button type="button" class="btn btn-primary">Add</button>
                            @else
                                @foreach ($addresses as $address)
                                    <div class="bg-white card addresses-item mb-4 shadow-sm">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">Work</h6>
                                                    <p>{{ $address->country }}, {{ $address->city }},
                                                        {{ $address->street }}, {{ $address->home }},
                                                        {{ $address->postcode }}</p>
                                                    <form method="POST" action="{{route('profile_address_submit')}}">
                                                        @csrf
                                                        <input type="hidden" name="address_id" value="{{$address->id}}">
                                                        <div class="row mb-1">
                                                            <div class="col-sm-2">
                                                                <h6 class="mb-0">Country</h6>

                                                            </div>
                                                            <div class="col">
                                                                <select class="form-select"
                                                                    name="country"
                                                                    required>
                                                                    <option selected>CZ</option>
                                                                    <option value="US">US</option>
                                                                    <option value="UK">UK</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-2">
                                                                <h6 class="mb-0">City</h6>

                                                            </div>
                                                            <div class="col">
                                                                <input type="text" class="form-control " id="city"
                                                                    name="city" aria-describedby="city"
                                                                    value="{{ $address->city }}" required>
                                                            </div>

                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-2">
                                                                <h6 class="mb-0">Street</h6>

                                                            </div>
                                                            <div class="col">
                                                                <input type="street" class="form-control " id="street"
                                                                    name="street" aria-describedby="street"
                                                                    value="{{ $address->street }}" required>
                                                            </div>

                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-2">
                                                                <h6 class="mb-0">House</h6>

                                                            </div>
                                                            <div class="col">
                                                                <input type="home" class="form-control "
                                                                    id="home" name="home" aria-describedby="home"
                                                                    value="{{ $address->home }}" required>
                                                            </div>

                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-sm-2">
                                                                <h6 class="mb-0">Postcode</h6>

                                                            </div>
                                                            <div class="col">
                                                                <input type="postcode" class="form-control "
                                                                    id="postcode" name="postcode"
                                                                    aria-describedby="postcode"
                                                                    value="{{ $address->postcode }}" required>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-7">
                                                            <button type="sumbit"
                                                                class="btn btn-primary mb-1">Update</button>
                                                    </form>
                                                    <form>
                                                        @csrf
                                                        <input type="hidden" name="address_id" value="{{$address->id}}">
                                                        <button type="sumbit" class="btn btn-danger">Delete</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!--Orders-->
                <div class="card mb-3" id="orders">
                    <div class="card-body">
                        <h3>Orders:</h3>
                        @if (empty($orders))
                            <p>You have no orders... Wanna make one?</p>
                        @else
                            @foreach ($orders as $order)
                                <div class="card">
                                    <div class="card-header">
                                        ID: {{ $order->id }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Date: {{ $order->created_at }}</h5>
                                        <p class="card-text">Status: {{ $order->status }}</p>
                                        <p class="card-text">Total price: {{ $order->total_price }}$</p>
                                        <p class="card-text">Payment method: {{ $order->payment_method }}</p>
                                        <a href="#" class="btn btn-primary">Details</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
