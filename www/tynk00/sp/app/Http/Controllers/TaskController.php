<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $activeTasks = Task::where('user_id', Auth::id())->where('completed', 0)->get();
        $closedTasks = Task::where('user_id', Auth::id())->where('completed', 1)->get();
        return view('tasks/index', compact('activeTasks', 'closedTasks', 'projects'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'due' => 'nullable',
            'project_id' => 'nullable',
            'user_id' => 'required'
        ]);

        $task = Task::create($validatedData);

        if($task->project_id != null){
            $project = Project::where('id', $task->project_id)->first();
            return redirect()->route('projects.show', compact(('project')))->with('success', 'Projekt byl úspěšně přidán!');
        }
        else{
            return redirect()->route('tasks')->with('success', 'Projekt byl úspěšně přidán!');
        }


    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function complete(Request $request, Task $task)
    {
        $task->completed = $request->has('completed');
        $task->save();

        return back();
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'nullable',
            'due' => 'nullable',
            'description' => 'nullable',
        ]);

        $task = Task::where('id', $request->taskId)->first();

        $task->update($validatedData);

        return redirect()->route('tasks')->with('success', 'Úkol byl úspěšně upraven!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }

    public function displayModal(Task $task)
    {
        $projects = Project::all();
        return view('compotents.tasks.modal', compact('task', 'projects'))->render();
    }
}
