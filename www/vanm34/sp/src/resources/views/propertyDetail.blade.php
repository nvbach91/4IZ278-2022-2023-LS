<!DOCTYPE html>
<html>
@include('partials.header')

<body>
    @include('partials.navbar')

    <div class="wrapper">
        @include('partials.sidebar')



        <!-- Page Content -->
        <div id="content">
            <div class="property-details-container">

                <!-- Display the small description at the top -->
                <h2>{{ $property->description }}</h2>

                <hr>

                <!-- Property Details -->
                <div class="property-details">
                    <h3>Property Details:</h3>
                    <p>
                        @if ($property->rentsale == 1)
                        <strong>Status:</strong> For Rent
                        <br>
                        <strong>Price:</strong> {{ $property->price }} €/month
                        @elseif ($property->rentsale == 2)
                        <strong>Status:</strong> For Sale
                        <br>
                        <strong>Price:</strong> {{ $property->price }} €
                        @endif
                    </p>
                    <p><strong>Size:</strong> {{ $property->size }} sqm</p>
                    <p><strong>Location:</strong> {{ $property->city }}, {{ $property->street }}</p>
                    <p><strong>Long Description:</strong> {{ $property->longDescription }}</p>
                    <hr>
                    <p><strong>Owner's Email:</strong> {{ $property->user->email }}</p>
                    <p><strong>Owner's Phone Number:</strong> {{ $property->user->phone_number }}</p>
                </div>

                <div class="property-images">
                    <h3>Property Images:</h3>
                    <div class="image-grid">
                        @foreach ($property->images as $image)
                        <div class="image-wrapper">
                            <a href="{{ $image->imagepath }}" target="_blank">
                                <img src="{{ $image->imagepath }}" alt="Property Image">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>



                @if (Auth::check())
                @if (auth()->user()->isInterestedIn($property->id))
                <form method="POST" action="{{ route('property.interested', $property->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Remove Interest</button>
                </form>
                @else
                <form method="POST" action="{{ route('property.interested', $property->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Mark as Interesting</button>
                </form>
                @endif
                @endif


            </div>
        </div>

    </div>
    </div>
</body>

@include('partials.footer')

</html>