@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Trending Categories</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trendingCategories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->posts_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Trending Tags</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Posts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trendingTags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
