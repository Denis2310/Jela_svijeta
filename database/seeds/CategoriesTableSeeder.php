<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class, 5)->create();
        
        foreach(App\Category::all() as $category){

        	$category->slug = "category-".$category->id;
        	$category->save();
        }
    }
}
