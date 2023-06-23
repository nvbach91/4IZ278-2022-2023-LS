@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                    <strong>{{session()->get('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                    <strong>{{session()->get('error')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif($errors->any('errors'))
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                        <strong>{{$error}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="row">
                        @foreach($orders as $order)
                            <div class="col-2">
                                <a href="{{route('order.admin.show',$order->id)}}">
                                    <button class="text-center btn btn-primary ">Order #{{$order->id}}</button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
