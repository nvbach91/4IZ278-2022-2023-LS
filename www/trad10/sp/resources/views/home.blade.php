@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::check())
        <div class="jumbotron text-center">
            <h1>Welcome, {{ Auth::user()->name }}!</h1>
            <p>Ready to share your thoughts?</p>
            <p>
                <a class="btn btn-primary btn-lg" href="{{ route('posts.create') }}" role="button">Create a New Post</a>
            </p>
        </div>
    @endif
    @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    @if($post->categories->count() > 0)
                        |
                    @endif
                    @foreach($post->categories as $category)
                        <span class="text-muted category " style="cursor: pointer;"> {{ $category->name }}</span>
                    @endforeach
                </h5>
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

    <script>
        function attachEventListener(elements) {
        elements.forEach(element => {
            element.addEventListener('click', function(e) {
                var searchInput = document.querySelector('#search-input');
                searchInput.value = e.target.textContent.trim();
                document.querySelector('#search-form').submit();
            });
        });
    }

    var tags = document.querySelectorAll('.tag');
    attachEventListener(tags);

    var categories = document.querySelectorAll('.category');
    attachEventListener(categories);
    </script>
</div>
@endsection