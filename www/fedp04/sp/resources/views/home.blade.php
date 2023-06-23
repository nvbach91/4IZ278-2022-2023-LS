@extends('layouts.app')

@section('css')
    <link href="{{ asset('frontend/css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container products">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach ($products as $product)
                <div class="card p-3 bg-white"><i class="fa fa-apple"></i>
                    <a href="{{route('product', $product->id)}}">
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
                    <form action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="redirect" value="home">
                        <div class="cart mt-4 align-items-center"> <button type="submit"
                                class="btn btn-danger text-uppercase mr-3 px-5" >Add to cart</button> <i
                                class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
        {!! $products->links() !!}

    </div>
@endsection
