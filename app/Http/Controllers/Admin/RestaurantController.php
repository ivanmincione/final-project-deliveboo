<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $newRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $newCategory = Category::with('restaurants')->get();
        $query = Restaurant::join('category_restaurant', 'restaurants.id', '=', 'category_restaurant.restaurant_id')->join('categories', 'category_restaurant.category_id', '=', 'categories.id')->where('restaurants.user_id', Auth::user()->id)->get();
        $data = [
            'restaurant' => $newRestaurant,
            'categories' => $query
        ];
        return redirect()->route('admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::All()
        ];
        return view('admin.restaurants.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'city' => 'required|max:100',
            'address' => 'required|max:100',
            'categories' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:512',
            'description' => 'required|max:300'
        ]);
        $data = $request->all();
        // dd($data);
        $newRestaurant = new Restaurant();

        if(array_key_exists('image', $data)) {
            $coverPath = Storage::put('restaurantsCover', $data['image']);
            $data['cover'] = $coverPath;
        }

        $newRestaurant->fill($data);
        $newRestaurant->user_id = Auth::user()->id;
        $slug = Str::slug($newRestaurant->name, '-');
        $slugEditable = $slug;
        $currentSlug = Restaurant::where('slug', $slug)->first();
        $counter = 1;
        while($currentSlug) {
            $slug = $slugEditable . '-' . $counter;
            $counter++;
            $currentSlug = Restaurant::where('slug', $slug)->first();
        }
        $newRestaurant->slug = $slug;
        $newRestaurant->save();
        if(array_key_exists('categories', $data)) {
            $newRestaurant->categories()->sync($data['categories']);
        }
        return redirect()->route('admin.restaurants.index', $data['categories']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
