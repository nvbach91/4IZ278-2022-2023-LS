<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Project;
use App\Models\Task;

use Illuminate\Support\Facades\Validator;

class TaskManager extends Component
{

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
            $tasks = Task::where('user_id', Auth::id())->orderBy('completed', 'asc')->orderBy('due', 'asc')->get();
        }
        else{
            $tasks = Task::where('user_id', Auth::id())->where('completed', 0)->orderBy('completed', 'asc')->orderBy('due', 'asc')->get();
        }

        return view('livewire.task-manager', compact('tasks', 'projects'));

    }


    public function createTask(){
        $this->name = null;
        $this->description = null;
        $this->due = null;
        $this->taskId = null;
        $this->project_id = null;
    }

    public function storeTask(){
        $task = new Task;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due = $this->due;
        $task->project_id = $this->project_id;
        $task->user_id = Auth::id();
        $task->save();
    }

    public function editTask($taskId){
        $task = Task::where('id', $taskId)->first();
        $this->name = $task->name;
        $this->description = $task->description;
        $this->due = $task->due;
        $this->taskId = $taskId;
        $this->project_id = $task->project_id;
    }

    public function updateTask(){

        $task = Task::where('id', $this->taskId)->first();
        $task->name = $this->name;
        $task->description = $this->description;
        $task->due = $this->due;
        $task->project_id = $this->project_id;
        $task->save();
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

    public function deleteTask($taskId){
        $task = Task::where('id', $taskId)->first();
        $this->taskId = $task->id;
    }

    public function destroyTask(){
        $task = Task::where('id', $this->taskId)->first();
        $task->delete();
    }

}
