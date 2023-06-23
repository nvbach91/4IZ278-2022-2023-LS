<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function showProperties()
    {
        $user = auth()->user();

        $properties = $user->properties;

        if ($properties === null) {
            // The user doesn't have any properties
            // Handle this case as you see fit, for example:
            return redirect()->back()->with('error', 'You do not have any properties.');
        }

        $properties = $properties->map(function ($property) {
            $property->interest_count = $property->interestedUsers->count();
            return $property;
        });

        return view('property-NoOfInterests', ['properties' => $properties]);
    }
}
