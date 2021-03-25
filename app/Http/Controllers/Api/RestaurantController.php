<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function index() {


    $data = Restaurant::all();
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}
}
