<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Meal::class, function (Faker $faker) {

	$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        'title' => $faker->unique()->foodName(),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'category_id' => $faker->optional()->numberBetween(1,5),
        'created_at' => date("Y-m-d H:i:s"),
    ];
});



