<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    // Store Image
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // Public Folder
        Storage::disk('public')->putFileAs('images', $request->image, $imageName);

        $user = Auth::user();

        $asset = Asset::create([
            'name' => $request->image->getClientOriginalName(),
            'path' => asset('storage/images/' . $imageName),
            'mime_type' => $request->image->getMimeType(),
            'user_id' => $user->id
        ]);

        return response()->json($asset);
    }

    // Get Assets
    public function getAssets(Request $request)
    {
        $assets = Asset::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return response()->json($assets);
    }
}