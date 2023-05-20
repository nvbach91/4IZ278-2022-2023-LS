@extends('layout')

@section('content')
    <div class="bg-space rounded text-white shadow p-3 mb-3">
        <h1>Add Galaxy</h1>
    </div>

    <div class="bg-space rounded text-white shadow p-3 mb-3">

        <form action="{{ route('galaxies.store') }}" method="post">
            @csrf
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <br>
            <label for="size" class="form-label">Size:</label>
            <input type="text" class="form-control" name="size" id="size" required>
            <br>
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description"></textarea>
            <br>
            <label for="image_url" class="form-label">Image URL:</label>
            <input type="text" class="form-control" name="image_url" id="image_url" required>
            <br>
            <button class="btn btn-light mt-2" type="submit">Add</button>
        </form>
    </div>
@endsection
