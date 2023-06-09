<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class TrendingController extends Controller
{
    public function index()
    {
        $trendingCategories = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        $trendingTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        return view('trending', ['trendingCategories' => $trendingCategories, 'trendingTags' => $trendingTags]);
    }
}

