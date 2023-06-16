<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eGarden</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script
  src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
  integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE="
  crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>
            <div class="header-home">
                <a href="./"><img src="{{ asset('img/homepage_logo.png') }}" alt="Logo redirecting to homepage"></a>
            </div>
            <div class="header-goods">
                <a href="./goods/">Browse goods</a>
            </div>
            @if(session()->exists('id'))
            <div class="header-other">
                <a href="./cart/">Cart</a>
            </div>
            <div id="account" class="header-other">
                <a href="./">Account</a>
            </div>
            @else
            <div class="header-other">
                <a href="./register/">Register</a>
            </div>
            <div class="header-other">
                <a id="account" href="./login/">Login</a>
            </div>
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
    @if(session('role')=='customer')
    <script src="{{ asset('js/layout.js') }}"></script>
    @elseif(session('role')=='admin')
    <script src="{{ asset('js/layout-admin.js') }}"></script>
    @else
    <script src="{{ asset('js/layout-logged-out.js') }}"></script>
    @endif
</body>
</html>