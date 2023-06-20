<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function interests()
    {
        // Get the currently authenticated user.
        $user = auth()->user();

        // Fetch all properties that this user is interested in.
        $interests = $user->interests;

        // Pass the interesting properties to the view.
        return view('interests', ['interests' => $interests]);
    }
}
