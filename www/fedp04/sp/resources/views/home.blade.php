@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container products">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach ($products as $product)
                <div class="card p-3 bg-white"><i class="fa fa-apple"></i>
                    <a href="/product/{{ $product->id }}">
                        <div class="about-product text-center mt-2"><img src="{{ $product->img }}" height="200">
                            <div>
                                <h4>{{ $product->name }}</h4>
                                <h6 class="mt-0 text-black-50">{{ $product->price }} {{ 'Kč' }}</h6>
                            </div>
                        </div>
                        <div class="stats mt-2">
                            <div class="d-flex justify-content-between p-price"><span>{{ $product->description }}</span>
                            </div>

                        </div>

                        {{-- <form method="post" action="{{route('cart.add')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="submit" value="add to cart">
                </form> --}}
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
