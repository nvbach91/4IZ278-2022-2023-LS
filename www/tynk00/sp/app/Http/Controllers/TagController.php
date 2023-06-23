<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Task;
use App\Models\Project;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        $colors = Color::all();
        return view('tags.index', compact('tags', 'colors'));
    }

    public function create()
    {
        $colors = Color::all();
        return view('tags.create', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'required'
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->color= $request->color;
        $tag->user_id = $request->user_id;
        $tag->save();

        return redirect()->route('tags')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        $colors = Color::all();
        return view('tags.edit', compact('tag', 'colors'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'nullable'
        ]);

        $tag = Tag::where('id', $request->id)->first();

        $tag->name = $request->name;
        $tag->color = $request->color;
        
        $tag->save();

        return redirect()->route('tags')->with('success', 'Tag byl úspěšně upraven.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags')->with('success', 'Tag úspěšně.');
    }

    public function attachTagsToProject(Request $request, Project $project)
    {
        $tagIds = $request->input('tag_ids', []);
        $project->tags()->sync($tagIds);
        
        return redirect()->route('projects.show', $project)->with('success', 'Tags attached successfully.');
    }

    public function attachTagsToTask(Request $request, Task $task)
    {
        $tagIds = $request->input('tag_ids', []);
        $task->tags()->sync($tagIds);

        return redirect()->route('tasks.show', $task)->with('success', 'Tags attached successfully.');
    }
}
