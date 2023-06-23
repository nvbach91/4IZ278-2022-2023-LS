<!DOCTYPE html>
<html>

@include('partials.header')

<body>

  @include('partials.navbar')

  <div class="wrapper">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Page Content -->
    <div id="content">
      <div class="filter">
        <h4>Filters:</h4>


        <form id="filterForm" action="{{ route('propertiesList.index') }}" method="GET" onsubmit="return handleFormSubmit(event)">
          <div class="form-group">
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
              <option value="">--Select--</option>
              <!-- Request is for values being stored in filter dropdown -->
              <option value="price_asc" {{ request()->sort == 'price_asc' ? 'selected' : '' }}>Price low to high</option>
              <option value="price_desc" {{ request()->sort == 'price_desc' ? 'selected' : '' }}>Price high to low</option>
              <option value="size_asc" {{ request()->sort == 'size_asc' ? 'selected' : '' }}>Size low to high</option>
              <option value="size_desc" {{ request()->sort == 'size_desc' ? 'selected' : '' }}>Size high to low</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status">
              <option value="">--Select--</option>
              <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>For Rent</option>
              <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>For Sale</option>
            </select>
          </div>
          <div class="form-group">
            <label for="property_type">Type:</label>
            <select name="property_type" id="property_type">
              <option value="">--Select--</option>
              <option value="1" {{ request()->property_type == '1' ? 'selected' : '' }}>Apartment</option>
              <option value="2" {{ request()->property_type == '2' ? 'selected' : '' }}>House</option>
              <option value="3" {{ request()->property_type == '3' ? 'selected' : '' }}>Lot</option>
            </select>
          </div>


          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="{{ request('city') }}">
          </div>

          <!-- Check if Status is also picked if you try to sort -->
          @if ($errors->has('status'))
          <div class="alert alert-danger">
            {{ $errors->first('status') }}
          </div>
          @endif

          <div class="form-group">
            <button type="submit">Apply</button>
            <a href="{{ route('propertiesList.index') }}" class="button">Reset</a>
          </div>
        </form>
      </div>

      <div class="MainPageText">Properties</div>

      @foreach ($properties as $property)
      <div class="property-container">
        <h3>{{ $property->description }}</h3>
        <hr>
        <p>
          @if ($property->rentsale == 1)
        <h5 style="background-color:lightgreen;">For Rent</h5>
        <p>Price: {{ $property->price }} €/month</p>
        @elseif ($property->rentsale == 2)
        <h5 style="background-color:lightcoral;">For Sale</h5>
        <p>Price: {{ $property->price }} €</p>
        @endif
        </p>

        <p>Size: {{ $property->size }}</p>

        <!-- Display the city and street of the property in one line -->
        <p>{{ $property->city }}, {{ $property->street }}</p>

        @if($property->images->where('is_main', true)->first())
        <div class="image-wrapper">
          <img src="{{ $property->images->where('is_main', true)->first()->imagepath }}" alt="Property Image">
        </div>
        @endif

        <a href="{{ route('properties.show', $property->id) }}" class="moreInfoButton">View More</a>

      </div>
      @endforeach

      <!-- Render pagination links and keeps the parametrs in URL so filter applies for every page-->
      {{ $properties->appends(request()->input())->links() }}


    </div>
  </div>
  </div>
</body>

<script type="text/javascript">
  //Deletes from URL the paramater which is not used
  function handleFormSubmit(event) {
    var form = document.getElementById('filterForm');


    if (form.sort.value === "") {
      form.sort.disabled = true;
    }


    if (form.status.value === "") {
      form.status.disabled = true;
    }


    if (form.property_type.value === "") {
      form.property_type.disabled = true;
    }


    if (form.city.value.trim() === "") {
      form.city.disabled = true;
    }

    return true;
  }
</script>
@include('partials.footer')

</html>