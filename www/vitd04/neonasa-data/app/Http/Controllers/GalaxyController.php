<?php

namespace App\Http\Controllers;

use App\Models\Galaxy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalaxyController extends Controller
{
    public function all(): View
    {
        return view('galaxy.list', [
            'galaxies' => Galaxy::all()
        ]);
    }

    public function show($id): View
    {
        $galaxy = Galaxy::findOrFail($id);
        $spaceStations = $galaxy->spaceStations()->get();
        return view('galaxy.detail', [
            'galaxy' => $galaxy,
            'spaceStations' => $spaceStations
        ]);
    }
}