<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Restaurant;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MatanYadaev\EloquentSpatial\Objects\Point;

class RestaurantController extends Controller
{
    // Search for a restaurant
    public function search(Request $request)
    {
        $request->validate([
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'page' => ['numeric'],
            'per_page' => ['numeric', 'min:1', 'max:100'],
        ]);

        $page = $request->page ?? 1;
        $perPage = $request->per_page ?? 10;

        // Find restaurants ordered  from closest to furthest that are visible with average rating and total rating
        $restaurants = Restaurant
            ::query()->withDistance('location', new Point($request->lat, $request->lng))
            ->orderBy('distance', 'asc')
            ->with('thumbnail')
            ->where('visible', true)
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($restaurants);

        // Search for restaurants based on the search term and return the results
        //return Restaurant::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:50', 'min:3', 'unique:' . Restaurant::class],
        ]);

        $user = Auth::user();

        Log::debug($user);

        $restaurant = Restaurant::create([
            // 'name' => $request->name,
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'user_id' => $user->id,
        ]);

        return response()->json($restaurant);
    }

    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required', 'string', 'exists:' . Restaurant::class . ',id'],
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'address' => ['required', 'string', 'max:200', 'min:2'],
            'city' => ['required', 'string', 'max:50', 'min:2'],
            'zip' => ['required', 'string', 'max:10', 'min:2'],
            'visible' => ['required', 'boolean'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'thumbnail_id' => ['string', 'exists:' . Asset::class . ',id']
        ]);

        $user = Auth::user();
        $restaurant = Restaurant::findOrFail($request->id);

        if ($restaurant->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not own this restaurant.'
            ], 403);
        }

        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->city = $request->city;
        $restaurant->zip = $request->zip;
        $restaurant->thumbnail_id = $request->thumbnail_id;
        $restaurant->visible = $request->visible;
        $restaurant->location = new Point($request->lat, $request->lng);

        $restaurant->slug = str_slug($request->name);
        $restaurant->save();

        return response()->json($restaurant);
    }

    public function getMyRestaurants(Request $request): JsonResponse
    {
        $user = Auth::user();

        $restaurants = Restaurant::where('user_id', $user->id)->get();

        return response()->json($restaurants);
    }

    public function getRestaurantDetail(Request $request): JsonResponse
    {
        $slug = $request->input('slug');
        $user = Auth::user();
        $restaurant = Restaurant::with([
            'menuSections.menuItems' => function ($query) {
                $query->where('visible', true)->orWhereHas('menuSection.restaurant', function ($query) {
                    $query->where('user_id', Auth::id());
                });
            },
            'menuSections.menuItems.thumbnail',
            'thumbnail'
        ])->withAvg('ratings', 'rating')
            ->withCount('ratings')->where('slug', $slug)->first();

        if ($restaurant === null) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        }

        if ($user === null) {
            $restaurant->isOwner = false;
        } else {
            $restaurant->isOwner = $restaurant->user_id === $user->id;
        }

        if ($restaurant->visible === false && $restaurant->isOwner === false) {
            return response()->json(['error' => 'Restaurant not found'], 404);
        }

        if ($restaurant->location) {
            $restaurant->lat = $restaurant->location->latitude;
            $restaurant->lng = $restaurant->location->longitude;
        }

        return response()->json($restaurant);
    }
}