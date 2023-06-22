@php use App\Models\Category; @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>
    <div id="app container">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/img/smalllogo.png') }}" class="img-fluid logo">
            </a>
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <div class="container text-center">
                            <div class="container text-center">

                            </div>

                        </div>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Authentication Links -->
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
                            <li class="nav-item m-1">
                                <a href ="{{route('cart')}}">Cart</a>
                            </li>

                            <li class="nav-item m-1">
                                <a href ="{{route('profile')}}">Profile</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-5">
            <div class=" row">
                <div class="col-2">
                    <div class="row align-items-start">




                        @foreach (Category::all() as $category)
                            <a href="{{ url('category', ['id' => $category->id]) }}">
                                <h4>{{ $category->category }}</h4>
                            </a>
                        @endforeach

                    </div>
                </div>
                <main class="py-8  col-10">
                    @yield('content')
                </main>

            </div>
        </div>
        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p> Copyright 2023 FrogStore.
                            Phone: +420 703 955 016
                            Adress: Praha 4, Chemická 953
                            E-mail: frogstoreoff@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </footer>



    </div>
    <!-- Scripts -->
    <!-- SOBAKA vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" defer></script>
</body>

</html>
