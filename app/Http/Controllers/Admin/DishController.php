<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Dish $dish)
    {
        $categories = Category::all();
        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        if ($userRestaurant) {
            $newDishes = Dish::where('restaurant_id', $userRestaurant->id)->orderBy('name', 'ASC')->get();
            $data = [
                'dishes' => $newDishes,
                'categories' => $categories
            ];
            return view('admin.dishes.index', $data);
        }

        $data = [
            'categories' => $categories
        ];

        return view('admin.restaurants.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'visible' => 'required|boolean',
            'price' => 'required|numeric|gt:0',
            'image' => 'nullable|image|max:512'
        ]);
        $data = $request->all();
        $newDish = new Dish();

        // verifico se è stata caricata un'immagine
        if(array_key_exists('image', $data)) {
            // salvo l'immagine e recupero la path
            // il primo parametro del put è una sottocartella che crea quando si fa upload del file
            $coverPath = Storage::put('dishesCover', $data['image']);
            $data['cover'] = $coverPath;
        }

        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $newDish->restaurant_id = $userRestaurant->id;
        $newDish->fill($data);

        $slug = Str::slug($newDish->name, '-');

        $slugEditable = $slug;

        $currentSlug = Dish::where('slug', $slug)->first();

        $counter = 1;
        while($currentSlug) {
            $slug = $slugEditable . '-' . $counter;
            $counter++;
            $currentSlug = Dish::where('slug', $slug)->first();
        }

        $newDish->slug = $slug;

        $newDish->save();
        return redirect()->route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        // dd($dish);
        if (!$dish) {
            abort(404);
        }
        $data = ['dish' => $dish];
        // dd($data);
        return view('admin.dishes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        // dd($dish);
        if (!$dish) {
            abort(404);
        }
        $data = [
            'dish' => $dish
        ];
        return view('admin.dishes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        // dd($dish);

        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'visible' => 'required|boolean',
            'price' => 'required|numeric|gt:0',
            'image' => 'nullable|image|max:512'
        ]);
        $data = $request->all();

        if(array_key_exists('image', $data)) {
            $coverPath = Storage::put('dishesCover', $data['image']);
            $data['cover'] = $coverPath;
        }

        if ($data['name'] != $dish->name) {

            $slug = Str::slug($data['name'], '-');

            $slugEditable = $slug;

            $currentSlug = Dish::where('slug', $slug)->first();

            $counter = 1;
            while($currentSlug) {
                $slug = $slugEditable . '-' . $counter;
                $counter++;
                $currentSlug = Dish::where('slug', $slug)->first();
            }

            $data['slug'] = $slug;
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $dish = Dish::where('slug', $slug)->first();

        $dish->delete();
        return redirect()->route('admin.dishes.index');
    }
}
