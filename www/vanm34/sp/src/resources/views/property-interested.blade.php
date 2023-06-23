<!DOCTYPE html>
<html>
@include('partials.header')

<body>
    @include('partials.navbar')

    <div class="wrapper">
        @include('partials.sidebar')

        <div id="content">
            <h2>Properties You're Interested In</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Size</th>
                        <th>City</th>
                        <th>Street</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interestedProperties as $property)
                    <tr>
                        <td>{{ $property->description }}</td>
                        <td>{{ $property->size }}</td>
                        <td>{{ $property->city }}</td>
                        <td>{{ $property->street }}</td>
                        <td>{{ $property->price }}</td>
                        <td>{{ $property->rentsale == 1 ? 'For Rent' : 'For Sale' }}</td>
                        <td>
                            <a href="{{ route('property.show', $property) }}" class="btn btn-success">View Details</a> |
                            <form action="{{ route('property.uninterest', $property->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Unmark as Interested</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @include('partials.footer')
</body>

</html>