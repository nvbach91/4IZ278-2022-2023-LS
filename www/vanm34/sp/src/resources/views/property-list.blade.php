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
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <h1>Properties</h1>
            <a href="{{ route('property.create') }}" class="btn btn-primary mb-3">Add New Property</a>
            @if($properties->isEmpty())
            <p>No properties found for this user.</p>
            @else
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Rent/Sale</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Address</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($properties as $property)
                  <tr>
                    <td>{{ $property->description }}</td>
                    <td>
                      @switch($property->property_type)
                      @case(1) Apartment @break
                      @case(2) House @break
                      @case(3) Lot @break
                      @default Unknown
                      @endswitch
                    </td>
                    <td>{{ $property->rentsale == 1 ? 'Rent' : 'Sale' }}</td>
                    <td>{{ $property->size }}</td>
                    <td>{{ $property->price }}</td>
                    <td>{{ $property->street }}, {{ $property->city }}</td>
                    <td>
                      <a href="{{ route('property.edit', $property) }}" class="btn btn-success">Edit</a>
                      <form method="POST" action="{{ route('property.destroy', $property) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

@include('partials.footer')

</html>