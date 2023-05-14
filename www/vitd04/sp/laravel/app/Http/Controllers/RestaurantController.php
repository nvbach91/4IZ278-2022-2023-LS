<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Search for a restaurant
    public function search(Request $request)
    {
        $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
        ]);

        return [];

        // Search for restaurants based on the search term and return the results
        //return Restaurant::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
    }
}