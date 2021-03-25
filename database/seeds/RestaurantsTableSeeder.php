<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantsData = config('restaurants');

        for ($i=0; $i < count($restaurantsData) ; $i++) {

            $newRestaurant = new Restaurant();

            $newRestaurant->name = $restaurantsData[$i]['name'];
            $newRestaurant->city = $restaurantsData[$i]['city'];
            $newRestaurant->address = $restaurantsData[$i]['address'];
            $newRestaurant->cover = $restaurantsData[$i]['cover'];
            $newRestaurant->description = $restaurantsData[$i]['description'];


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
        }

    }
}
