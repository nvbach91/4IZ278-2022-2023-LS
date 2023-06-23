<!DOCTYPE html>
<html>
@include('partials.header')

<body>
    @include('partials.navbar')

    <div class="wrapper">
        @include('partials.sidebar')

        <div id="content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Size</th>
                        <th>City</th>
                        <th>Street</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Interested Users</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->description }}</td>
                        <td>{{ $property->size }}</td>
                        <td>{{ $property->city }}</td>
                        <td>{{ $property->street }}</td>
                        <td>{{ $property->price }}</td>
                        <td>{{ $property->rentsale == 1 ? 'For Rent' : 'For Sale' }}</td>
                        <td>{{ $property->interest_count }}</td>
                        </td>
                        <td>
                            <a href="{{ route('property.show', $property) }}" class="btn btn-success">View Details</a> |
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