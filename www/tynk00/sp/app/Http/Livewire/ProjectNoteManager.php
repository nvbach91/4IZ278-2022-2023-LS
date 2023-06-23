<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Note;

class ProjectNoteManager extends Component
{
    public $searchTerm;

    public $project;

    public function render()
    {

        $notes = Note::where('user_id', Auth::id())->where('project_id', $this->project->id)->where(function ($query) {
            $query->orWhere('title', 'LIKE', "%$this->searchTerm%")
                ->orWhere('body', 'LIKE', "%$this->searchTerm%");
        })->get();;



        return view('livewire.project-note-manager', ['notes' => $notes]);
    }
}
