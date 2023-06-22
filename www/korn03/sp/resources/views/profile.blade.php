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
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ $user->name }} {{ $user->surname }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ $user->email }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->phone ? $user->phone : 'Not specified' }}</div>
                            </div>
                            <hr>
                            <div class="col-sm-2">
                                <a type="sumbit" href="{{route('profile_edit')}}" class="btn btn-primary">Edit</a>
                            </div>
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
                                                <p>{{$address->country}}, {{$address->city}}, {{$address->street}}, {{$address->home}}, {{$address->postcode}}</p>
                                            </div>
                                            <div class="col-sm-7">
                                                <a href="{{route("profile_edit")}}"
                                                    class="btn btn-primary mb-1">Edit</a>
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
                            <div class="card mb-2">
                                <div class="card-header">
                                ID: {{$order->id}}
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title">Date: {{$order->created_at}}</h5>
                                  <p class="card-text">Status: {{$order->status}}</p>
                                  <p class="card-text">Total price: {{$order->total_price}}$</p>
                                  <p class="card-text">Payment method: {{$order->payment_method}}</p>
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
