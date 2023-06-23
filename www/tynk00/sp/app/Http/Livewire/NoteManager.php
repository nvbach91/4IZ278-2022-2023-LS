<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Note;

class NoteManager extends Component
{
    public $searchTerm;

    public $title;
    public $body;
    public $noteId;
    public $color;

    public function render()
    {

        $notes = Note::where('user_id', Auth::id())->where(function ($query) {
            $query->orWhere('title', 'LIKE', "%$this->searchTerm%")
                ->orWhere('body', 'LIKE', "%$this->searchTerm%");
        })->orderBy('updated_at', 'desc')->get();

        return view('livewire.note-manager', ['notes' => $notes]);
    }


}
