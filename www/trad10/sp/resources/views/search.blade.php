@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Search results for "{{ $query }}"</h1>

    @if($posts->isNotEmpty())
    @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                <p class="card-subtitle mb-2 text-muted">{{ $post->created_at->format('m/d/Y') }}</p>
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
