<?php

use Illuminate\Database\Seeder;
use database\factories\MealFactory;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Meal::class, 15)->create();

        foreach(App\Meal::all() as $meal){

        	$meal->slug = "meal-".$meal->id;
        	$meal->save();
        }
    }
}
    
