<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {

    $categories = Category::all();
    // $categoriesRestaurants = Category::with('restaurants')->get();
    $data = [
        'categories' => $categories,
        // 'categoriesRestaurants' => $categoriesRestaurants
    ];
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}

    public function categoriesRestaurants() {

    $categoriesRestaurants = Category::with('restaurants')->get();
    $data = [
        'categoriesRestaurants' => $categoriesRestaurants
    ];
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
}
