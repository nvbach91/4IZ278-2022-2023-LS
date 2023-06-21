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
                                <div class="col-sm-9 text-secondary">{{ $user->phone ? $user->phone : '-' }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> Bay Area, San Francisco, CA</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12"> <a class="btn btn-info " target="__blank" href="#">Edit</a>
                                </div>
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
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"
                                                        data-toggle="modal" data-target="#add-address-modal"
                                                        href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a
                                                        class="text-danger" data-toggle="modal"
                                                        data-target="#delete-address-modal" href="#"><i
                                                            class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <!--Orders-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3>Orders:</h3>
                            @if (empty($orders))
                            <p>You have no orders... Wanna make one?</p>
                            @else
                            @foreach ($orders as $order)
                            <p>order</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
