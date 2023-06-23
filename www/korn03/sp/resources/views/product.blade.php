@extends('layouts.app')

@php

    use App\Models\Product;
    use App\Http\Controllers\ProductController;
@endphp


@section('content')
    <div class="container-fluid col-8 d-flex flex-row flex-wrap mt-4 align-items-start gap-3 ">
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <form method="POST" action="{{ route('add_to_cart') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                src={{ asset('/assets/img/products/' . $product->thumbnail) }}
                                alt="{{ $product->name }} image" />
                        </div>
                        <div class="col-md-6">
                            <div class="small mb-1">Code: {{ $product->code }}</div>
                            <h1 class="display-5 fw-bolder">{{ $product->brand }}</h1>
                            <h2 class="display-5 ">{{ $product->name }}</h2>

                            @if ($product->discount > 0)
                                <div class="fs-5 mb-5">
                                    <span class="text-decoration-line-through">{{ $product->price }}$</span>
                                    <span>{{ $product->price - $product->discount }}$</span>
                                </div>
                            @else
                                <div class="fs-5 mb-5">
                                    <span>{{ $product->price }}$</span>
                                </div>
                            @endif
                            @if ($product->stock == 0)
                                <p class="card-price text-danger">Out of stock</p>
                            @else
                                <p class="card-price text-success">In stock</p>
                            @endif
                            <p class="lead">{{ $product->description }}</p>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="num"
                                    name="quantity" value="1" style="max-width: 3rem" />
                                <button
                                    class="btn btn-outline-dark flex-shrink-0
                                @if ($product->stock <= 0) disabled @endif
                                "
                                    type="submit">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                    <form>
            </div>
        </section>
        <!-- Related items section-->
        @if (!$relatedProducts->isEmpty())

        <section class="py-5 bg-light container rounded">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 gap-2 mb-2">

                    @foreach ($relatedProducts as $product)
                        <div class="card " style="width: 11rem;">
                            <a href="{{ route('product', $product->id) }}"><img
                                    src="{{ asset('/assets/img/products/' . $product->thumbnail) }}" class="card-img-top"
                                    alt="{{ $product->name }} thumbnail"></a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <h6 class="card-price">{{ $product->price }}$</h5>
                                    <p class="card-price text-success">In stock</p>
                                    <a href="{{ route('product', $product->id) }}" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $relatedProducts->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </section>
        @endif
    </div>
@endsection
