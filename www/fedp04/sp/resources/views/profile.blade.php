@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="border-right">
                <div class="p-3 py-5r">
                    <form method="post" action="{{route('profile.update')}}">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text" name="name"
                                    class="form-control" placeholder="first name" value="{{$user->name}}"></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text" name="surname"
                                    class="form-control" value="{{$user->surname}}" placeholder="surname"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email"
                                    class="form-control" placeholder="enter email id" value="{{$user->email}}"></div>
                            <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" name="phone"
                                    class="form-control" placeholder="enter phone number" value="{{$user->phone}}"></div>
                            <div class="col-md-12"><label class="labels">Address</label><input type="text" name="adress"
                                    class="form-control" placeholder="enter address line 1" value="{{$user->adress}}"></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Update
                                Profile</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
