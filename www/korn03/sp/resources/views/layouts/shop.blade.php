@php use App\Models\Category; @endphp
@extends('layouts.app')


<!-- ASIDE BAR CATEGORIES-->
@section('content')
    <div class="row">
        <div class="flex-shrink-0 p-3 bg-white column" style="width: 280px;">
            <ul class="list-unstyled ps-0">
                <li class="mb-1 ">
                    <div class="text-center">
                        <button class="btn btn-toggle align-items-center rounded collapsed align-center"
                            data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                            Categories
                        </button>
                        <div>
                            <div class="collapse show" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @foreach (Category::all() as $category)
                                        <li class="text-center"><a href="{{ url('category', ['id' => $category->id]) }}"
                                                class="link-dark rounded">{{ $category->name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                </li>
                <li class="border-top my-3"></li>
            </ul>
        </div>
        <div class="column col-9">
            <div class="container-fluid col-fill d-flex flex-row flex-wrap mt-4 align-items-start gap-3 mb-2">
                @yield('products')
            </div>
            <div class="d-flex p-2 justify-content-center">
            @yield('pagination')
            </div>
        </div>
    </div>
@endsection
