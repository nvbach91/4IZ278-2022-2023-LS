<?php

namespace App\Http\Controllers;

use App\Models\MenuSection;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MenuSectionController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:50', 'min:3', 'unique:' . MenuSection::class],
            'restaurant_id' => ['required', 'string', 'exists:' . Restaurant::class . ',id']
        ]);

        $user = Auth::user();
        $restaurant = Restaurant::find($request->restaurant_id);

        // Check if the user owns the restaurant
        if ($restaurant->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not own this restaurant.'
            ], 403);
        }

        // Get the max position for the menu section or default to 0
        $getMaxPosition = MenuSection::where('restaurant_id', $restaurant->id)->max('position') ?? 0;

        $menuSection = MenuSection::create([
            'name' => $request->name,
            'restaurant_id' => $restaurant->id,
            'position' => $getMaxPosition + 1
        ]);

        return response()->json($menuSection);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required', 'numeric', 'exists:' . MenuSection::class . ',id'],
        ]);

        $user = Auth::user();
        $menuSection = MenuSection::find($request->id);

        // Check if the user owns the restaurant
        if ($menuSection->restaurant->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not own this restaurant.'
            ], 403);
        }

        $menuSection->delete();

        return response()->json([
            'message' => 'Menu section deleted.'
        ]);
    }
}