<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $categories = Category::all();
        return view('adminDashboard', compact('users', 'categories'));
    }
    
    public function updateUserStatus(User $user)
    {
        $user->archived = !$user->archived;
        $user->save();

        return redirect()->back()->with('status', 'User status updated!');
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        Category::create($validatedData);

        return redirect()->back()->with('status', 'Category created!');
    }


    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('status', 'Category deleted!');
    }
}
