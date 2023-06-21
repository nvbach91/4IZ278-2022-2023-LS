<!DOCTYPE html>
<html>
<!-- content -->

@include('partials.header')

<body>
  @include('partials.navbar')


  <div class="wrapper">
    @include('partials.sidebar')


    <!-- Page Content -->
    <div id="content">
      <div class="MainPage">Welcome</div>
      <img class="MainPage" src="{{ asset('img/house.jpg') }}" height="15%" width="100%">


      <div class="MainPageText">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin in tellus sit amet nibh dignissim sagittis. Proin pede metus, vulputate nec, fermentum fringilla
        , vehicula vitae, justo. Et harum quidem rerum facilis est et expedita distinctio. Donec quis nibh at felis congue commodo. Nulla accumsan, elit sit amet varius semper, nulla mauris mol
        lis quam, tempor suscipit diam nulla vel leo. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Sed ac dolor sit amet purus malesuada congue. Etiam posuere lac
        us quis dolor. Aliquam erat volutpat.
      </div>

      <div class="circle-container">
        <!-- Apartment -->
        <div class="circle">
          <h3>{{ $numberOfApartments }}</h3>
          <p>Apartments</p>
          <div class="sub-circles">
            <div class="sub-circle">
              <h4>{{ $numberOfApartmentsForRent }}</h4>
              <p>For Rent</p>
            </div>
            <div class="sub-circle">
              <h4>{{ $numberOfApartmentsForSale }}</h4>
              <p>For Sale</p>
            </div>
          </div>
        </div>

        <!-- House -->
        <div class="circle">
          <h3>{{ $numberOfHouses }}</h3>
          <p>Houses</p>
          <div class="sub-circles">
            <div class="sub-circle">
              <h4>{{ $numberOfHousesForRent }}</h4>
              <p>For Rent</p>
            </div>
            <div class="sub-circle">
              <h4>{{ $numberOfHousesForSale }}</h4>
              <p>For Sale</p>
            </div>
          </div>
        </div>

        <!-- Lots -->
        <div class="circle">
          <h3>{{ $numberOfLots }}</h3>
          <p>Lots</p>
          <div class="sub-circles">
            <div class="sub-circle">
              <h4>{{ $numberOfLotsForRent }}</h4>
              <p>For Rent</p>
            </div>
            <div class="sub-circle">
              <h4>{{ $numberOfLotsForSale }}</h4>
              <p>For Sale</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@include('partials.footer')

</html>