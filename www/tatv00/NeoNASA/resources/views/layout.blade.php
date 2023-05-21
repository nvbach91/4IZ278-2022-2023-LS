<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/256/1534/1534067.png">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <title>NeoNASA</title>

    <style>
        .bg-space {
            background-color: #310047 !important;
        }

        .btn-space {
            background-color: #310047 !important;
            color: white;
        }

        .btn-space:hover {
            color: white;
            background-color: #4f0f6d !important;
        }

        .btn-space:active {
            color: white;
            background-color: #4f0f6d !important;
        }

        .text-bg-space {
            background-color: #310047 !important;
            color: white
        }

        .toast-space {
            background-color: #5a147a !important;
            color: white
        }
    </style>

</head>

<body class="bg-space bg-gradient">
    <div class="py-0"
        style="background-image: url('https://images2.alphacoders.com/521/521477.jpg'); background-attachment: fixed;">
        <div style="background-color: rgba(49, 0, 71, 0.7);">
            <x-navbar />
            <div class="container bg-gradient px-5 py-5 shadow-lg" style="background-color: rgba(255, 255, 255, 0.5);">
                @yield('content')
            </div>
            <x-footer />
        </div>

    </div>

    @if(session('message'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="myToast" class="toast toast-space" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                      {{ session('message') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const showToastBtn = document.getElementById('showToastBtn');
            const myToast = new bootstrap.Toast(document.getElementById('myToast'));
            myToast.show();
        </script>
    @endif



</body>

</html>
