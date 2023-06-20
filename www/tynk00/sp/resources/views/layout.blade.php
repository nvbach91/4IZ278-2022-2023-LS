<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TaskShin</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap 4.6.2/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <livewire:styles />

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: Roboto;
            src: url('{{ asset('fonts/roboto/Roboto-Regular.ttf') }}');
        }

        * {
            font-family: Roboto, sans-serif;
        }
    </style>
</head>

<body>

    <x-app.navbar />

    <div class="container-fluid py-3">

        @yield('content')



    </div>


    @isset($success)
        <div id="myToast" class="toast position-fixed" style="right: 20px; bottom: 20px" role="alert"
            aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header bg-dark">
                <strong class="mr-auto text-light">Upozornění</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ $success }}
            </div>
        </div>
    @endisset




    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="{{ asset('js/bootstrap 4.6.2/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    <livewire:scripts />


    @isset($success)
        <script>
            var toast = document.getElementById('myToast');
            var bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        </script>
    @endisset








</body>

</html>
