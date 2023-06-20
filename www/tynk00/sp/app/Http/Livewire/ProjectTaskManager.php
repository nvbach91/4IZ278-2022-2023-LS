<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Project;
use App\Models\Task;

class ProjectTaskManager extends Component
{

    public $project;

    public $name;
    public $description;
    public $due;
    public $project_id;
    public $taskId;

    public $closedTasks;

    public function render()
    {
        $projects = Project::where('user_id', Auth::id())->get();

        

        if($this->closedTasks){
            $tasks = Task::where('user_id', Auth::id())->where('project_id', $this->project->id)->orderBy('completed', 'asc')->orderBy('due', 'asc')->get();
        }
        else{
            $tasks = Task::where('user_id', Auth::id())->where('completed', 0)->orderBy('completed', 'asc')->orderBy('due', 'asc')->get();
        }

        $this->project_id = $this->project->id;
        return view('livewire.task-manager', compact('tasks', 'projects'));

    }

    public function updateTask($taskId){
        $task = Task::where('id', $taskId)->first();
        $this->name = $task->name;
        $this->description = $task->description;
        $this->due = $task->due;
        $this->taskId = $taskId;
        $this->project_id = $task->project_id;
    }

    public function completeTask($taskId){
        $task = Task::where('id', $taskId)->first();

        if($task->completed){
            $task->completed = 0;
        }
        else{
            $task->completed = 1;
        }
        $task->save();
    }

}
