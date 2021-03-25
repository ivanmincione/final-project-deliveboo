<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Category;
use App\Dish;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        $data = [
            'restaurants' => $restaurants,
            'categories' => $categories
        ];
        return view('guest.restaurants.index', $data);
    }


    public function show($slug) {

       $restaurantDishes = Restaurant::where('slug', $slug)->with('dishes')->get();
       if(!$restaurantDishes) {
           abort(404);
       }
       $data = [
           'restaurantDishes' => $restaurantDishes
        ];
       return view('guest.restaurants.show', $data);
   }

 }
