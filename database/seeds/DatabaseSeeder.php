<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MealsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(MealTagTableSeeder::class);
        $this->call(IngredientMealTableSeeder::class);
    }
}
