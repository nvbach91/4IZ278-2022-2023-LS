@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    <!-- User Management -->
    <h2>Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form method="POST" action="{{ route('updateUserStatus', $user) }}">
                        @csrf
                        @if ($user->IsArchived())
                            <button type="submit" class="btn btn-success">Reactivate</button>
                        @else
                            <button type="submit" class="btn btn-danger">Archive</button>
                        @endif
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Category Management -->
    <h2>Categories</h2>

    <!-- Form to create new category -->
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
        </div>
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>

    <!-- List all categories -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
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
@endsection
