<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Models\Category;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index() : Renderable
    {
        return view('home', ['categories' => Category::all()]);
    }

    /**
     * Show the admin dashboard.
     */
    public function adminIindex() : Renderable
    {
        return view('admin');
    }
}
