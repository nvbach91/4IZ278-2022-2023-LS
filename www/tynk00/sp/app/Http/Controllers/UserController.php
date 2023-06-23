<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordChanged;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function showSettings()
    {
        return view('users.settings');
    }

    public function dashboard(){
        
        if (Auth::check()) {
            $tags = Tag::where('user_id', Auth::id())->get();
            $tagCounts = [];
            foreach ($tags as $tag){
                $tagCounts[$tag->name] = $tag->projects->count();
            }

            $tasks = Task::where('user_id', Auth::id())->get();

            $taskCounts = [$tasks->where('completed', 1)->count(), $tasks->where('completed', 0)->count()];

            $projects = Project::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(4)->get();
            return view('dashboard', compact('tags', 'projects', 'tagCounts', 'taskCounts'));
        }
        return view('homepage');
        
    }
    /**
     * Update the user's name and password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => 'nullable',
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ]);

        $user->name = $request->name;

        $user->avatar = $request->avatar;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Mail::to($user->name)->send(new PasswordChanged());

        return redirect()->back()->with('success', 'Your changes have been saved.');
    }
}
