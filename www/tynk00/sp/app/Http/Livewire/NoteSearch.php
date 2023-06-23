<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteSearch extends Component
{
    public $searchTerm;

    public function render()
    {

        $notes = Note::where('user_id', Auth::id())->where(function ($query) {
            $query->orWhere('title', 'LIKE', "%$this->searchTerm%")
                ->orWhere('body', 'LIKE', "%$this->searchTerm%");
        })->get();;



        return view('livewire.note-search', ['notes' => $notes]);
    }
}
