@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>Edit Space Station</h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <form action="{{ route('space_stations.update', $space_station->id) }}" method="post">
            @csrf
            @method('PUT')
            <label class="form-label" for="name">Name:</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $space_station->name }}" required>
            <br>
            <label class="form-label" for="gps_3d_coordinates">3D GPS Coordinates:</label>
            <input class="form-control" type="text" name="gps_3d_coordinates" id="gps_3d_coordinates"
                value="{{ $space_station->gps_3d_coordinates }}" required>
            <br>
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description">{{ $space_station->description }}</textarea>
            <br>
            <label class="form-label" for="image_url">Image URL:</label>
            <input class="form-control" type="text" name="image_url" id="image_url" value="{{ $space_station->image_url }}" required>
            <br>
            <label class="form-label" for="galaxy_id">Galaxy:</label>
            <select class="form-control" name="galaxy_id" id="galaxy_id" required>
                @foreach ($galaxies as $galaxy)
                    <option value="{{ $galaxy->id }}" {{ $space_station->galaxy_id == $galaxy->id ? 'selected' : '' }}>
                        {{ $galaxy->name }}</option>
                @endforeach
            </select>
            <br>
            <button class="btn btn-light mt-2" type="submit">Update</button>
        </form>
    </div>
@endsection
