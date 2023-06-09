@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Search results for "{{ $query }}"</h1>

    @if($posts->isNotEmpty())
    @foreach($posts as $post)
    <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h5>
                    <p class="text-muted mb-0">{{ $post->user->name }}</p>
                </div>
                @if($post->categories->count() > 0)
                    @foreach($post->categories as $category)
                        <span class="text-muted category " style="cursor: pointer;"> {{ $category->name }}</span>
                    @endforeach
                @endif
                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                <p class="card-subtitle mb-2 text-muted">{{ $post->created_at->setTimezone('Europe/Prague')->format('m/d/Y H:i:s') }}</p>
                <div>
                    @foreach($post->tags as $tag)
                        <span class="badge bg-secondary m-1 tag" style="cursor: pointer;">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    @else
        <p class="text-center my-4">No results found.</p>
    @endif
</div>
@endsection
