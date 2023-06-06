@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Post</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group my-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group my-3">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            </div>

            <div class="form-group my-3">
                <label for="categories">Categories</label>
                <select multiple class="form-control" id="categories" name="categories[]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-3">
                <label for="tags">Tags (separated by commas or spaces)</label>
                <input type="text" class="form-control" id="tags" name="tags">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
