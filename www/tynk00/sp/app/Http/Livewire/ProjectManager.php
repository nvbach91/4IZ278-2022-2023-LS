<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectManager extends Component
{
    public $searchTerm;

    public $sortBy = 'name';

    public function render()
    {
        $projects = Project::where('user_id', Auth::id())->where('name', 'like', '%'.$this->searchTerm.'%')->orderBy($this->sortBy, 'asc')->get();

        return view('livewire.project-manager', ['projects' => $projects]);
    }
}
