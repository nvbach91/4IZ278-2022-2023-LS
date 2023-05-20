@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>Edit Galaxy</h1>
    </div>
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <form action="{{ route('galaxies.update', $galaxy->id) }}" method="post">
            @csrf
            @method('PUT')
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $galaxy->name }}" required>
            <br>
            <label for="size" class="form-label">Size:</label>
            <input type="text" class="form-control" name="size" id="size" value="{{ $galaxy->size }}" required>
            <br>
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description">{{ $galaxy->description }}</textarea>
            <br>
            <label for="image_url" class="form-label">Image</label>
            <label for="image_url" class="form-label">Image URL:</label>
            <input type="text" class="form-control" name="image_url" id="image_url" value="{{ $galaxy->image_url }}"
                required>
            <br>
            <button class="btn btn-light mt-2" type="submit">Update</button>
        </form>
    </div>
@endsection
