<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Color;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }

    public function create()
    {
        $colors = Color::all();
        $projects = Project::where('user_id', Auth::id())->get();
        return view('notes.create', compact('colors', 'projects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'user_id' => 'required|integer',
            'project_id' => 'nullable',
            'color' => 'nullable'
        ]);

        $note = Note::create($validatedData);

        return redirect()->route('notes');


    }
    public function edit(Note $note)
    {
        $colors = Color::all();
        $projects = Project::where('user_id', Auth::id())->get();
        return view('notes.edit', compact('note', 'colors', 'projects'));
    }

    public function update(Request $request, Note $note)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'user_id' => 'required|integer',
            'project_id' => 'nullable',
            'color' => 'nullable'
        ]);

        $note->update($validatedData);

        if($note->project != null){
            $note->project->updated_at = now();
            $note->project->save();
        }

        return redirect()->route('notes');
    }

    public function destroy(Note $note)
    {

        if($note->project != null){
            $note->project->updated_at = now();
            $note->project->save();
        }

        $note->delete();


        return redirect()->route('notes');
    }
}
