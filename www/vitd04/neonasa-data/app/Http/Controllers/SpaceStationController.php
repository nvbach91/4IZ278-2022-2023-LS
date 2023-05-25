<?php

namespace App\Http\Controllers;

use App\Models\SpaceStation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpaceStationController extends Controller
{
    public function all(): View
    {
        return view('space-station.list', [
            'space_stations' => SpaceStation::all()
        ]);
    }

    public function show($id): View
    {
        $ss = SpaceStation::findOrFail($id);
        return view('space-station.detail', [
            'space_station' => $ss,
        ]);
    }
}