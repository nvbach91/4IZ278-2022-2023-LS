@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-header">{{ __('Dashboard') }}</div>

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
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="150px"
                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                                class="font-weight-bold">Edogaru</span><span
                                class="text-black-50">edogaru@mail.com.my</span><span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <form method="post" action="{{route('profile.update')}}">
                                @csrf
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels" for="first-name">Name</label>
                                        <input id="first-name" name="first_name" type="text" class="form-control"
                                               placeholder="First name" value="{{$user->first_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels" for="last-name">Surname</label>
                                        <input id="last-name" name="last_name" type="text" class="form-control"
                                               placeholder="Last name" value="{{$user->last_name}}">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="phone">Phone Number</label>
                                    <input id="phone" name="phone" type="text" class="form-control"
                                           placeholder="Enter phone number" value="{{$user->phone}}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label class="labels" for="email">Email</label>
                                    <input id="email" name="email" type="text" class="form-control" placeholder="enter email id"
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
                            <div class="d-flex justify-content-between align-items-center experience">
                                <h4>Active addresses</h4>
                                <span class="border px-3 p-1 add-experience">
                                    <i class="fa fa-plus"></i>&nbsp;Adress
                                </span>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="labels" for="">Address Line 1</label>
                                <input type="text" class="form-control" placeholder="enter address line 1"
                                       value="">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="labels">Additional Details</label>
                                <input type="text" class="form-control" placeholder="additional details" value="">
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                                                                                  class="form-control"
                                                                                                  placeholder="country"
                                                                                                  value="">
                                </div>
                                <div class="col-md-6"><label class="labels">State/Region</label><input
                                        type="text" class="form-control" value="" placeholder="state"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
