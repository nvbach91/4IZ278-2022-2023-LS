<?php


namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller {

    public function fetchAll() {
        $categories = Category::all();
        return $categories;
    }
}

?>