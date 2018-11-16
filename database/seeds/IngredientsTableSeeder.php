<?php

use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ingredient::class, 50)->create();
        
        foreach(App\Ingredient::all() as $ingredient){

        	$ingredient->slug = "ingredient-".$ingredient->id;
        	$ingredient->save();
        }
    }
}
