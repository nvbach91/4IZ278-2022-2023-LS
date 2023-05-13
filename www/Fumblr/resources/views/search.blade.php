@extends('layouts.app')

@section('content')
    <h1>Search results for "{{ $query }}"</h1>

    @if($posts->isNotEmpty())
        @foreach($posts as $post)
            <div class="post">
                <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
                <p>{{ Str::limit($post->body, 100) }}</p>
                <p>Posted by {{ $post->user->name }}</p>
            </div>
        @endforeach
    @else
        <p>No results found.</p>
    @endif
@endsection