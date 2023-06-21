<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\Interested;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PropertiesController extends Controller
{
    public function index(Request $request)
    {
        try {
            $request->validate([
                'sort' => 'nullable|in:price_asc,price_desc,size_asc,size_desc',
                'status' => [
                    'nullable',
                    'in:1,2',
                    Rule::requiredIf($request->sort !== null),
                ],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors(['status' => 'You must choose a status if you want to sort the properties.']);
        }

        $query = Property::query()->with('images');

        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price');
            } elseif ($request->sort == 'price_desc') {
                $query->orderByDesc('price');
            } elseif ($request->sort == 'size_asc') {
                $query->orderBy('size');
            } elseif ($request->sort == 'size_desc') {
                $query->orderByDesc('size');
            }
        }



        if ($request->has('status')) {
            $query->where('rentsale', $request->status);
        }

        if ($request->has('city') && trim($request->city) != "") {
            $query->where('city', 'LIKE', '%' . trim($request->city) . '%');
        }

        $properties = $query->paginate(9);

        return view('properties', compact('properties'));
    }

    public function show(Property $property)
    {
        return view('propertyDetail', compact('property'));
    }
}
