<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
class PublicController extends Controller
{

    public function index() : Renderable
    {
        return view('index', ['items' => Item::latest()->paginate(4)]);
    }

    public function category($id)
    {
        $rootCategory = Category::find($id);
        if ($rootCategory == null) {
            return redirect()->route('index');
        }
        if (Category::all()->where('category_id', $rootCategory->id)->count() > 0) {
            $categoryIds = Category::select('id')->where('category_id', $rootCategory->id)->get()->toArray();
        } else {
            $categoryIds = [$rootCategory->id];
        }
        return view('index', ['items' => Item::latest()->whereIn('category_id', $categoryIds)->paginate(4), 'categoryName' => $rootCategory->name]);
    }

    public function product($id) : Renderable
    {
        $item = Item::find($id);
        $relatedItems = Item::all()->whereNotIn('id', $item->id)->where('category_id', $item->category_id)->take(4);
        return view('product', ['item' => $item, 'relatedItems' => $relatedItems]);
    }
}
