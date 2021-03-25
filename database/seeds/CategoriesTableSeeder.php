<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesData = config('categories');

        for ($i=0; $i < count($categoriesData) ; $i++) {

            $newCategory = new Category();

            $newCategory->name = $categoriesData[$i]['name'];

            $slug = Str::slug($newCategory->name, '-');

            $slugEditable = $slug;

            $currentSlug = Category::where('slug', $slug)->first();

            $counter = 1;
            while($currentSlug) {
                $slug = $slugEditable . '-' . $counter;
                $counter++;
                $currentSlug = Category::where('slug', $slug)->first();
             }

            $newCategory->slug = $slug;

            $newCategory->save();
        }

    }
}
