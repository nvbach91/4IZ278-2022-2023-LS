<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Galaxy;

class GalaxyController extends Controller {
    
    public function fetchById($id) {
        //querybuilder
    }
    public function fetchAll() {
        $galaxies = Galaxy::all();
        foreach($galaxies as $galaxy) {
            echo $galaxy->name;
        }
        return $galaxies;
    }

    
    public function fetchAllByGalaxyId($id) {
        //querybuilder
    }
}
