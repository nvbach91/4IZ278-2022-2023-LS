@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('posts.update', $post) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control">{{ $post->content }}</textarea>
            </div>

            <div class="form-group my-3">
                <label for="categories">Categories</label>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" name="categories[]" {{ $post->categories->contains($category->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" id="tags" name="tags" value="{{ $post->tags->pluck('name')->implode(', ') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
