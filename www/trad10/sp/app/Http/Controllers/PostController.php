<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Perform the query using the `like` operator in SQL
        $posts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->get();

        // Return the search view with the query results
        return view('search', ['posts' => $posts, 'query' => $query]);
    }
}
