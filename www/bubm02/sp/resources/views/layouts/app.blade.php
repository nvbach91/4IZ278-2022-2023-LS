<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Harmony House') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('config')
</head>
<body>
<div id="app container" style="width: auto">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Harmony House') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <!-- Authentication Links -->

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('cart.show')}}">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                            @if(session()->has('cart') && count(session()->get('cart')) > 0)
                                <span class='badge badge-warning' id='lblCartCount'> {{count(session()->get('cart'))}} </span>
                            @endif
                        </a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @endguest
                        </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row p-5">
        <aside class="col-2">
            <ul class="list-unstyled ps-0">
                @foreach($rootCategories as $category)
                    <li class="mb-1">
                        @php($hasChildCategories = count($category->childCategories()->getResults()) > 0)
                        @php($categoryCollapseId = str_replace(' ', '-',$category->name ).'-collapse')

                        <button class="btn btn-toggle align-items-center rounded collapsed bi-arrow-down" id="category-{{$category->id}}"
                                data-bs-toggle="collapse" data-bs-target="#{{$categoryCollapseId}}"
                                aria-expanded="false">
                            {{$category->name}}
                        </button>
                        @if($hasChildCategories)
                            <div class="collapse" id="{{$categoryCollapseId}}">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a href="{{route('category', $category->id)}}"
                                           class="link-dark rounded">{{$category->name}}</a></li>
                                    @foreach($category->childCategories as $childCategory)
                                        <li><a href="{{route('category', $childCategory->id)}}"
                                               class="link-dark rounded">{{$childCategory->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </aside>
        <main class="col-10 container">
            @yield('content')
        </main>
    </div>
</div>

<!-- Footer-->
{{--<footer class="py-5 bg-dark sticky-bottom">--}}
{{--    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>--}}
{{--</footer>--}}
<script>

</script>
<script defer src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
