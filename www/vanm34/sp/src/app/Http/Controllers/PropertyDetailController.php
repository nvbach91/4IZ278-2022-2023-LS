<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Interested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Property;


class PropertyDetailController extends Controller
{

    public function markAsInteresting($id)
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID.


        // Create a new record in the 'interested' table.
        DB::table('interested')->insert([
            'date_of_contact' => now(),
            'property_id' => $id,
            'user_id' => $userId
        ]);

        // Redirect back to the property details page with a success message.
        return redirect()->back()->with('status', 'Property marked as interesting!');
    }


    public function addInterest($id)
    {
        auth()->user()->interests()->create(['property_id' => $id]); //interests existuje, ale IDE ho nevidí
        return back();
    }

    public function removeInterest($id)
    {
        auth()->user()->interests()->where('property_id', $id)->delete();
        return back();
    }

    //for showing property in navbar
    public function show(Property $property)
    {
        return view('propertyDetail', compact('property'));
    }
}
