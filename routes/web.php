<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');

Route::get('/meals', 'FilterController@filter_meals')->name('filter_data');




/*Route::get('create', function() {
    
    $meals= Meal::all();

    foreach($meals as $meal){

    	foreach (['en', 'nl', 'fr', 'de'] as $locale) {
        $meal->translateOrNew($locale)->title;
    	}
    	
    	$meal->save();

    }

});*/

/*Route::get('/create', 'Controller@meals_translated');*/


/*Route::get('{locale}', function($locale) {
   
   app()->setLocale($locale);

   $meal = Meal::first();

   return view('meal')->with(compact('meal'));
});*/