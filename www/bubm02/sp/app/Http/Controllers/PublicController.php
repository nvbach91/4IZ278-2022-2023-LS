<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
class PublicController extends Controller
{

    public function index() : Renderable
    {
        return view('index', ['items' => Item::all()]);
    }

    public function category($id) : Renderable
    {
        return view('index', ['items' => Item::all()->where('category_id', $id)]);
    }

    public function product($id) : Renderable
    {
        return view('product', ['item' => Item::find($id)]);
    }
}
