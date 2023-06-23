<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id', 'color'];

    protected $primaryKey = 'id';

    public $timestamps = true;

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

    public function lastUpdate(){
        $updated_at = $this->attributes['updated_at'];
        Carbon::setLocale('cs');
        $timeSinceUpdate = Carbon::parse($updated_at)->diffForHumans();
        return $timeSinceUpdate;
    }
}
