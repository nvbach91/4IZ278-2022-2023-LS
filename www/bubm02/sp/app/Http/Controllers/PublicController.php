<?php

namespace App\Http\Controllers;

use App\Models\Item;

class PublicController extends Controller
{

    public function index()
    {
        return view('welcome', ['items' => Item::all()]);
    }

    public function product($id)
    {
        return view('product', ['item' => Item::find($id)]);
    }
}
