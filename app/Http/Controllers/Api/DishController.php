<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    public function index() {


    $data = Dish::all();
    return response()->json([
        'succes' => true,
        'response' => $data,
    ]);
}

}
