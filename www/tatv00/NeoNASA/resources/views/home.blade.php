@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>Vítejte v aplikaci NeoNASA</h1>
    </div>

    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <p class="bg-light text-dark rounded p-2">
            Tato aplikace je skvělým nástrojem pro všechny nadšence kosmu, kteří se chtějí dozvědět více o vesmírných
            stanicích a galaxiích. Uživatelé mohou prohlížet jednotlivé SS a GX pomocí URL parametru ID, což umožňuje snadné
            vyhledávání konkrétních objektů. <br>

            Tabulka s galaxiemi je užitečným zdrojem informací, kde uživatelé mohou nalézt další detaily o GX, včetně
            velikosti a obrázku. Rozkliknutím jednotlivých galaxií si pak mohou zobrazit seznam SS, které se v ní nacházejí.
            Tyto informace jsou doplněny o název, 3D GPS souřadnice a obrázek každé jednotlivé SS. <br>

            Celkově je tato aplikace velmi užitečná pro procházení a prohlížení informací o různých SS a GX. Pokud by v
            budoucnu měla být rozšířena, například o možnost vyhledávání podle určitých kritérií nebo interaktivní mapu
            vesmíru, mohla by být ještě zajímavější a uživatelsky přívětivější. <br>
        </p>
        <div class="row">
            <img src="https://api.time.com/wp-content/uploads/2014/06/flame-nebula-astronomy-chandra-telescope-nasa-space.jpg" alt="" class="col-lg-4 col-md-12 col-sm-12 shadow rounded">
            <img src="https://images.unsplash.com/photo-1615195627275-48660e9cd84f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTJ8fHxlbnwwfHx8fA%3D%3D&w=1000&q=80" alt="" class="col-lg-4 col-md-12 col-sm-12 shadow rounded">
            <img src="https://d3ezn0y6hdgq62.cloudfront.net/assets/photos/news/2020_06_03/large.jpeg" alt="" class="col-lg-4 col-md-12 col-sm-12 shadow rounded">
            <img src="https://stsci-opo.org/STScI-01FY71M4VEMWC4VZXFERDTE7AS.png" alt="" class="col-lg-4 col-md-12 col-sm-12 mt-4 shadow rounded">
            <img src="https://cdn.mos.cms.futurecdn.net/qffhAnbCiasdroDChnLS6U.jpg" alt="" class="col-lg-4 col-md-12 col-sm-12 mt-4 shadow rounded">
            <img src="https://cdn.spacetelescope.org/archives/images/large/heic0602e.jpg" alt="" class="col-lg-4 col-md-12 col-sm-12 mt-4 shadow rounded">
        </div>




    </div>
@endsection
