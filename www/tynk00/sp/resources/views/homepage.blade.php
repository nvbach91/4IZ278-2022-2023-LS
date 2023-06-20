<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>TaskShin</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('icons/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <style>
        @font-face { font-family: Roboto; src: url('{{ asset('fonts/roboto/Roboto-Regular.ttf') }}'); } 
        * {
            font-family: Roboto, sans-serif;
        }
    </style>
</head>

<body class="bg-light bg-gradient" style="display: flex; flex-direction: column; min-height: 100vh;">
    <!-- Navbar -->
    <x-navbar />
    <!-- End Navbar -->
    <!-- Main Content -->
    <div class="pt-5 w-100 homepage-cover" style="background-image: url('{{ asset('images/homepageWallpaper.jpg') }}'); height: 400px">
        <div class="container">
            <h1 class="mb-3">Vítejte v aplikaci TaskShin</h1>
            <p>Tato aplikace na vytváření projektů, úkolů a poznámek ti pomůže zvýšit produktivitu a efektivitu, a zároveň udržet všechny důležité informace na dosah. S její pomocí budeš mít větší kontrolu nad svými projekty a úkoly, a zároveň usnadníš spolupráci s týmem</p>
        </div>
    </div>

    <!-- End Main Content -->

    <section id="features" class="py-5" style="flex: 1">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="feature-box">
                <h3>Integrované poznámky pro efektivní záznamy</h3>
                <p>S naší aplikací nemusíš mít oddělenou aplikaci pro poznámky. Můžeš jednoduše vytvářet a ukládat poznámky přímo ve svých projektech a úkolech. Můžeš je organizovat do kategorií, přidávat klíčová slova a vyhledávat v nich. Tímto způsobem budeš mít všechny důležité informace na jednom místě.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-box">
                <i class="fas fa-chart-bar fa-3x"></i>
                <h3>Organizuj své projekty efektivněji</h3>
                <p>Naše aplikace ti umožní vytvořit a sledovat projekty různého rozsahu a složitosti. Díky intuitivnímu rozhraní můžeš snadno přidávat, upravovat a přehledně organizovat své úkoly a poznámky. Už nikdy neztratíš důležitou informaci nebo nedokončený úkol.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="feature-box">
                <i class="fas fa-mobile-alt fa-3x"></i>
                <h3>Přizpůsobení podle tvých potřeb</h3>
                <p>Rozumíme, že každý má své vlastní preferované způsoby organizace. Proto naše aplikace umožňuje přizpůsobit si rozložení, barvy a další aspekty tak, aby vyhovovaly tvým individuálním potřebám. Budeš mít pocit, že aplikace je přesně taková, jakou si přeješ..</p>
              </div>
            </div>
          </div>
        </div>
      </section>
     
      

    <x-footer />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>




</html>
