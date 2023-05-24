<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'user_id' => 'required|integer',
        ]);

        $project = Project::create($validatedData);

        return redirect()->route('projects.show', $project->id);
    }

    public function show(Project $project)
    {

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'user_id' => 'required|integer',
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.show', $project->id);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects');
    }
}
