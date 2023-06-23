<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Str;

class ProjectManager extends Component
{
    public $searchTerm;

    public $sortBy = 'name';

    public function render()
    {

        if (Str::startsWith($this->searchTerm, '#') && strlen($this->searchTerm) > 1) {
            $projects = Project::where('user_id', Auth::id())->WhereHas('tags', function ($query) {
                $query->where('name', 'like', "%".ltrim($this->searchTerm, '#')."%");
            })->orderBy($this->sortBy, 'desc')->get();
        } else {
            $projects = Project::where('user_id', Auth::id())->where('name', 'like', '%'.ltrim($this->searchTerm, '#').'%')->orderBy($this->sortBy, 'desc')->get();
        }


        return view('livewire.project-manager', ['projects' => $projects]);
    }
}

