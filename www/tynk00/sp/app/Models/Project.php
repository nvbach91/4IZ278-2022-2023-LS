<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id', 'color'];

    protected $primaryKey = 'id';

    protected $with = ['tags'];

    protected $atributes = [
        'name' => 'New project'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function activeTasks()
    {
        $tasks = $this->tasks();
        return $tasks->where('completed', 0);
    }

    public function closedTasks()
    {
        $tasks = $this->tasks();
        return $tasks->where('completed', 1);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
