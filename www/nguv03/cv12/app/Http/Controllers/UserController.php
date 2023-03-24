<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UserController extends Controller {
    public function fetchAll() {
        $users = DB::select("SELECT * FROM cv12_users WHERE 1;");
        $users = array_map(function ($user) {
            return (array) $user;
        }, $users);
        return $users;
    }
}