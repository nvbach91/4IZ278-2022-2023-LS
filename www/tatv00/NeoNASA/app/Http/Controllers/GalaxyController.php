<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galaxy;
use Illuminate\Http\Request;

class GalaxyController extends Controller
{
    public function index()
    {
        $galaxies = Galaxy::all();
        return view('galaxies.index', compact('galaxies'));
    }

    public function create()
    {
        return view('galaxies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'image_url' => 'required',
        ]);

        Galaxy::create($request->all());

        return redirect()->route('galaxies.index')
                         ->with('message', 'Galaxy created successfully.');
    }

    public function show(Galaxy $galaxy)
    {
        return view('galaxies.show', compact('galaxy'));
    }

    public function edit(Galaxy $galaxy)
    {
        return view('galaxies.edit', compact('galaxy'));
    }

    public function update(Request $request, Galaxy $galaxy)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'image_url' => 'required',
        ]);

        $galaxy->update($request->all());

        return redirect()->route('galaxies.index')
                         ->with('message', 'Galaxy updated successfully.');
    }

    public function destroy(Galaxy $galaxy)
    {
        $galaxy->delete();
        return redirect()->route('galaxies.index')
                         ->with('message', 'Galaxy deleted successfully.');
    }

    public function clear(Galaxy $galaxy)
    {
        $galaxy->spaceStations()->delete();

        return redirect()->route('galaxies.show', $galaxy)
                        ->with('message', 'All stations from this galaxy deleted successfully.');
    }

}
