<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
class PublicController extends Controller
{

    public function index() : Renderable
    {
        return view('index', ['items' => Item::latest()->paginate(4)]);
    }

    public function category($id) : Renderable
    {
        return view('index', ['items' => Item::latest()->where('category_id', $id)->paginate(4)]);
    }

    public function product($id) : Renderable
    {
        $item = Item::find($id);
        $relatedItems = Item::all()->whereNotIn('id', $item->id)->where('category_id', $item->category_id)->take(4);
        return view('product', ['item' => $item, 'relatedItems' => $relatedItems]);
    }
}
