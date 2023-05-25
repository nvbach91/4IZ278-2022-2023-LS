<!DOCTYPE html>
<html lang="cs" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ ("NeoNASA - ") . $title ?? "NeoNASA" }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')

    </head>
    <body class="h-full">
      <div class="min-h-full">
        <nav class="border-b border-gray-200 bg-white">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
              <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                  NeoNASA
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                  <a href="/" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium">Galaxies</a>
                  <a href="/space-stations" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium">SpaceStations</a>
                </div>
              </div>
              </div>
            </div>
        </nav>
        <div class="py-10">
          <header>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">{{ $title  }}</h1>
            </div>
          </header>
          <main>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
              {{ $slot }}
            </div>
          </main>
        </div>
      </div>
    </body>
</html>
