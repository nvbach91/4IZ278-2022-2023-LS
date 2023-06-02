<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'restaurant_id' => ['required', 'string', 'exists:' . Restaurant::class . ',id'],
        ]);

        $user = Auth::user();

        $rating = Rating::where('user_id', $user->id)
            ->where('restaurant_id', $request->restaurant_id)
            ->first();

        if ($rating) {
            $rating->update([
                'rating' => $request->rating,
            ]);
        } else {
            $rating = Rating::create([
                'rating' => $request->rating,
                'restaurant_id' => $request->restaurant_id,
                'user_id' => $user->id,
            ]);
        }

        return response()->json($rating);
    }

    public function get(Request $request): JsonResponse
    {
        $request->validate([
            'restaurant_id' => ['required', 'string', 'exists:' . Restaurant::class . ',id'],
        ]);

        $user = Auth::user();

        $rating = Rating::where('user_id', $user->id)
            ->where('restaurant_id', $request->restaurant_id)
            ->first();

        return response()->json($rating);
    }
}