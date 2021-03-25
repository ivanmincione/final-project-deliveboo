<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
   {
       $dishesData = config('dishes');

       for ($i=0; $i < count($dishesData) ; $i++) {
       $newDish = new Dish();
       $newDish->name = $dishesData[$i]['name'];
       $newDish->price = $dishesData[$i]['price'];
       $newDish->description = $dishesData[$i]['description'];
       // $newDish->visible = $dishesData[$i]['visible'];
       $newDish->cover = $dishesData[$i]['cover'];

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
        }
    }
}
