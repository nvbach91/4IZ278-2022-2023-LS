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

            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" id="tags" name="tags" value="{{ $post->tags->pluck('name')->implode(', ') }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
