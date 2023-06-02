<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MenuItem;
use App\Models\MenuSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
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
            'description' => ['required', 'string', 'max:256'],
            'kcal' => ['required', 'numeric', 'min:0'],
            'protein' => ['required', 'numeric', 'min:0'],
            'carbs' => ['required', 'numeric', 'min:0'],
            'fat' => ['required', 'numeric', 'min:0'],
            'amount_in_grams' => ['required', 'numeric', 'min:0'],
            'menu_section_id' => ['required', 'numeric', 'exists:' . MenuSection::class . ',id'],
            'thumbnail_id' => ['string', 'exists:' . Asset::class . ',id'],
            'visible' => ['required', 'boolean']
        ]);

        $user = Auth::user();
        $menuSection = MenuSection::with('restaurant')->findOrFail($request->menu_section_id);
        $restaurant = $menuSection->restaurant;

        // Check if the user owns the restaurant
        if ($restaurant->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not own this restaurant.'
            ], 403);
        }

        // Get the max position for the menu section or default to 0
        $getMaxPosition = MenuItem::where('menu_section_id', $request->menu_section_id)->max('position') ?? 0;

        $menuItem = MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'kcal' => $request->kcal,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'amount_in_grams' => $request->amount_in_grams,
            'menu_section_id' => $request->menu_section_id,
            'thumbnail_id' => $request->thumbnail_id,
            'position' => $getMaxPosition + 1,
            'visible' => $request->visible
        ]);

        return response()->json($menuItem);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'id' => ['required', 'numeric', 'exists:' . MenuItem::class . ',id'],
        ]);

        $user = Auth::user();
        $menuItem = MenuItem::with('menuSection.restaurant')->findOrFail($request->id);
        $menuSection = $menuItem->menuSection;
        $restaurant = $menuSection->restaurant;

        // Check if the user owns the restaurant
        if ($restaurant->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not own this restaurant.'
            ], 403);
        }

        // Delete the menu item
        $menuItem->delete();

        // Reorder the menu items
        $menuItems = MenuItem::where('menu_section_id', $menuSection->id)->orderBy('position', 'asc')->get();
        $position = 1;
        foreach ($menuItems as $menuItem) {
            $menuItem->position = $position;
            $menuItem->save();
            $position++;
        }

        return response()->json([
            'message' => 'Menu item deleted successfully.'
        ]);
    }
}