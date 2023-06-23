<?php
// app/Http/Controllers/PropertyController.php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Image;
use Illuminate\Http\Request;

class PropertyListController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', auth()->id())->get();
        // dd($properties);
        return view('property-list', compact('properties'));
    }

    public function create()
    {
        return view('property-create');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'description' => 'required|max:40',
            'longDescription' => 'required|max:255',
            'property_type' => 'required|integer|min:1|max:3',
            'rentsale' => 'required|numeric|min:1|max:2',
            'size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'street' => 'required|max:255',
            'city' => 'required|max:255|regex:/^[A-Za-z\s\-]+$/',
            'imagepath.*' => 'required|url',
        ]);

        // store data
        $property = new Property($request->all());
        $property->user_id = auth()->id();
        $property->save();



        foreach ($request->imagepath as $index => $imagepath) {
            $image = new Image();
            $image->imagepath = $imagepath;
            $image->property_id = $property->id;
            $image->is_main = $request->is_main == $index ? 1 : 0;
            $image->save();
        }

        return redirect()->route('property.index');
    }

    public function edit(Property $property)
    {
        return view('property-edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        //dd($request->all());
        // validation
        $request->validate([
            'description' => 'required|max:40',
            'longDescription' => 'required|max:255',
            'property_type' => 'required|integer|min:1|max:3',
            'rentsale' => 'required|numeric|min:1|max:2',
            'size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'street' => 'required|max:255',
            'city' => 'required|max:255|regex:/^[A-Za-z\s\-]+$/',
            'imagepath.*' => 'required|url',
        ]);

        // update data
        $property->fill($request->all());
        $property->user_id = auth()->id();
        $property->save();

        foreach ($property->images as $index => $image) {
            if (isset($request->imagepath[$index])) {
                $image->imagepath = $request->imagepath[$index];
                $image->is_main = $request->is_main == $index ? 1 : 0;
                $image->save();
            } else {
                // Remove image if it's not present in the request
                $image->delete();
            }
        }

        // For new images
        for ($i = count($property->images); $i < count($request->imagepath); $i++) {
            $image = new Image();
            $image->imagepath = $request->imagepath[$i];
            $image->property_id = $property->id;
            $image->is_main = $request->is_main == $i ? 1 : 0;
            $image->save();
        }

        return redirect()->route('property.index');
    }

    public function destroy(Property $property)
    {
        //odmazání interested z tabulky
        $property->interestedUsers()->delete();
    
        $property->delete();
    
        return redirect()->route('property.index');
    }
}
