<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%')
                    ->orWhereHas('tags', function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('categories', function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })->get();

        return view('search', ['posts' => $posts, 'query' => $query]);
    }



    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'tags' => 'nullable|string',
            'categories.*' => 'exists:categories,id',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->user()->id; 

        $post->save();

        $post->categories()->sync($request->categories);

        if (!empty($request->tags)) {
            $tagNames = preg_split('/[\s,]+/', $request->tags, -1, PREG_SPLIT_NO_EMPTY);
            $tagIds = [];

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);

                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('posts.show', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'required|array',
            'tags' => 'nullable|string',
            'categories.*' => 'exists:categories,id',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        $post->categories()->sync($request->categories);

        $tagNames = array_map('trim', explode(',', $request->tags));
        $tagIds = [];

        foreach($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        }

        $post->tags()->sync($tagIds);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        if(auth()->user()->id != $post->user_id && !auth()->user()->isAdmin()){
            return redirect()->route('posts.index');
        }

        $post->delete();

        return redirect()->route('home');
    }

}
