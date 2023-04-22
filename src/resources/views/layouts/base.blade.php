<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Eucalyptus - Bakery')</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=1" type="image/x-icon">


    @stack('styles')
</head>
<body>
<header class="p-3 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <img src="{{ asset('images/big_logo.png')}}" alt="Your Icon" width="50" height="50">
        </a>


            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-dark">Home</a></li>
                <li><a href="/store" class="nav-link px-2 text-dark">Store</a></li>
                <li><a href="/#about-section" class="nav-link px-2 text-dark">About</a></li>
            </ul>

            <div class="text-end">
            <button onclick="window.location.href='/cart'" class="btn btn-outline-dark me-2">
                <span>
                    <i class="bi bi-cart"></i> Cart ({{ \App\Http\Controllers\CartController::cartItemCount() }})
                </span>
            </button>
                @if (Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark me-2">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-dark me-2">Login</a>
                    <button onclick="window.location.href='/register'" class="btn btn-primary">Sign-up</button>
                @endif
            </div>

        </div>
    </div>
</header>

@yield('content')

<footer class="container">
    <p>&copy; 2020–2023 Eucalyptus &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>

@stack('scripts')

</body>
</html>
