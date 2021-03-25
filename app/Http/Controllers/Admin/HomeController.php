<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        return view('admin.home');
    }

    public function showRestaurant() {
        $newRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $newCategory = Category::with('restaurants')->get();
        $query = Restaurant::join('category_restaurant', 'restaurants.id', '=', 'category_restaurant.restaurant_id')->join('categories', 'category_restaurant.category_id', '=', 'categories.id')->where('restaurants.user_id', Auth::user()->id)->get();
        $data = [
            'restaurant' => $newRestaurant,
            'categories' => $query
        ];
        return view('admin.home', $data);
    }
}
