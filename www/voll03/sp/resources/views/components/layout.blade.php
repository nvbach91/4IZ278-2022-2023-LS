<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" />
    <title>Soundchecker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="flex flex-col md:h-screen min-h-screen">
    <x-flash-message />
    @include('partials._header')
    {{ $slot }}
    @include('partials._footer')
</body>

</html>