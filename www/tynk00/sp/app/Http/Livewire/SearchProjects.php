<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class SearchProjects extends Component
{
    public $searchTerm;

    public function render()
    {
        
        $projects = Project::where('user_id', Auth::id())->where('name', 'like', '%'.$this->searchTerm.'%')->get();

        return view('livewire.search-projects', ['projects' => $projects]);
    }
}
