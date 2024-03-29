@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <p class="text-muted mb-0">{{ $post->user->name }}</p>
                </div>
                <hr>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-subtitle mb-2 text-muted">{{ $post->created_at->setTimezone('Europe/Prague')->format('m/d/Y H:i:s') }}</p>
                @if(auth()->check() && (auth()->user()->id == $post->user_id || auth()->user()->isAdmin()))
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary mr-2">Edit Post</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete Post
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
