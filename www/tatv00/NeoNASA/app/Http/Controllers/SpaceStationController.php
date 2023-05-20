<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpaceStation;
use App\Models\Galaxy;
use Illuminate\Http\Request;

class SpaceStationController extends Controller
{
    public function index()
    {
        $space_stations = SpaceStation::all();
        return view('space_stations.index', compact('space_stations'));
    }

    public function create()
    {
        $galaxies = Galaxy::all();
        return view('space_stations.create', compact('galaxies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gps_3d_coordinates' => 'required',
            'image_url' => 'required',
            'galaxy_id' => 'required',
        ]);

        SpaceStation::create($request->all());

        return redirect()->route('space_stations.index')
                         ->with('message', 'Space Station created successfully.');
    }

    public function show(SpaceStation $space_station)
    {
        return view('space_stations.show', compact('space_station'));
    }

    public function edit(SpaceStation $space_station)
    {
        $galaxies = Galaxy::all();
        return view('space_stations.edit', compact('space_station', 'galaxies'));
    }

    public function update(Request $request, SpaceStation $spaceStation)
    {
        $request->validate([
            'name' => 'required',
            'gps_3d_coordinates' => 'required',
            'image_url' => 'required',
            'galaxy_id' => 'required',
        ]);

        $spaceStation->update($request->all());

        return redirect()->route('space_stations.show', $spaceStation)
                         ->with('message', 'Space Station updated successfully.');
    }

    public function destroy(SpaceStation $spaceStation)
    {
        $spaceStation->delete();
        return redirect()->route('space_stations.index')
                         ->with('message', 'Space Station deleted successfully.');
    }

    public function copy($id)
    {
        $newSpaceStation = new SpaceStation();

        $spaceStation = SpaceStation::findOrFail($id);

        $newSpaceStation->name = $spaceStation->name;
        $newSpaceStation->description = $spaceStation->description;
        $newSpaceStation->image_url = $spaceStation->image_url;
        $newSpaceStation->galaxy_id = $spaceStation->galaxy_id;
        $newSpaceStation->gps_3d_coordinates = $spaceStation->gps_3d_coordinates;

        $newSpaceStation->save();
        

        return redirect()->route('space_stations.index')
                         ->with('message', 'Space Station copied successfully.');
    }


}
