<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FilterRequest;

use App\Meal;
use App\Category;
use App\Tag;
use App\Ingredient;

use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

class FilterController extends Controller
{

    public function filter_meals(FilterRequest $request){

    	$per_page = 5; //default
		
        //Za ispis kategorija i tagova u filteru
        $filter_categories = Category::all();
        $filter_tags = Tag::all();

        //1. Postavljanje stranice koja će se prikazati nakon slanja zahtjeva
    	if($request->has('page')){

    		$currentPage = $request->page;
    		Paginator::currentPageResolver(function() use($currentPage){

    			return $currentPage;
    		});
    	}


        //2. Postavljanje broja jela po stranici
        if($request->per_page){ $per_page = $request->per_page; }
        

        //3. Ako ne postoji zahtjev za kategorijama i tagovima
    	if(!$request->has('category') && !$request->has('tags')) {
	    	
	    	//Provjera ako postoji samo zahtjev za broj jela po stranici
	    	if(only_meals_per_page($request)){

	    		$meals = Meal::paginate($per_page);
	    		
	    		return view('index', compact('meals', 'filter_categories', 'filter_tags'));
	    	}
        	
            //Ne postoji nikakvi zahtjev i vrati se na početak
    	    return redirect('/');
    	
    	//Postoji samo zahtjev za kategorijom
    	} else if($request->has('category') && !$request->has('tags')) {

            $result = filter_meals_by_category($request->category, $per_page);

        //Postoji samo zahtjev za tagovima
        } else if(!$request->has('category') && $request->has('tags')) {

       		$result = filter_meals_by_tags($request->tags, $per_page);

        //Postoji zahtjev za kategorijama i tagovima
        } else {

        	$result = filter_meals_by_categories_and_tags($request->category, $request->tags, $per_page);

        }

        $meals = $result['meals'];
        $message = $result['message'];

    	Session::flash('message', $message);
    	return view('index', compact('meals', 'filter_categories', 'filter_tags'));
    }

}

//Funkcija za dohvaćanje kategorija
function filter_meals_by_category($category, $per_page){

    $message="Categories: ";
    $result = array();

    if($category[0] === '!null') {
            
            $meals = Meal::where('category_id','!=', NULL)->paginate($per_page);
            $message = " With Category";

    } else if ($category[0] === 'null'){

            $meals = Meal::where('category_id','=', NULL)->paginate($per_page);
            $message = " Without Category";

        } else {

            $meals = Meal::whereIn('category_id', $category)->paginate($per_page);
            $requested_categories = Category::all()->whereIn('id', $category);

            foreach($requested_categories as $category){
            
                $message = $message.$category->title." ";
            }
        } 

    $result['meals'] = $meals;
    $result['message'] = $message;

    return $result; 
}

//Funkcija za dohvaćanje tagova
function filter_meals_by_tags($tags, $per_page){

	$message="Tags:";

	//Pronađeno riješenje koristeći stack overflow , moj način pretraživanja tagova nalazi se ispod u komentaru
	$meals = Meal::when($tags, function($query) use ($tags){
	             
	             foreach($tags as $tag){
	                 	
	                 $query->whereHas('tags', function($query) use ($tag){

	                 	$query->where('tag_id', $tag);
	                });
	             }
	         });


    $requested_tags = Tag::all()->whereIn('id', $tags);
	foreach($requested_tags as $tag){

    $message = $message.$tag->title." ";
	}

    $result['meals'] = $meals->paginate($per_page);
    $result['message'] = $message;
	
	return $result;
}

//Funkcija za dohvaćanje kategorija i tagova
function filter_meals_by_categories_and_tags($category, $tags, $per_page){

    $message="";

    if($category[0] === '!null') {
       	
       	$message = $message." With Categories";

        $meals = Meal::when($tags, function($query) use ($tags){
         
         foreach($tags as $tag){
             $query->whereHas('tags', function($query) use ($tag){

             	$query->where('tag_id', $tag);
            });
         }
    	})->where('category_id','!=', NULL);


    } else if ($category[0] === 'null'){

       	$message = $message." Without Category";

        $meals = Meal::when($tags, function($query) use ($tags){
         
         foreach($tags as $tag){
             $query->whereHas('tags', function($query) use ($tag){

             	$query->where('tag_id', $tag);
            });
         }
    	})->where('category_id','=', NULL);
            

    } else {

    	$message = $message." Categories: ";

        $meals = Meal::when($tags, function($query) use ($tags){
         
         foreach($tags as $tag){
             	
             $query->whereHas('tags', function($query) use ($tag){

             	$query->where('tag_id', $tag);
            });
         }
    	})->whereIn('category_id', $category); 

    	$requested_categories = Category::all()->whereIn('id', $category);

    	foreach($requested_categories as $category){

    		$message = $message.$category->title." ";
    	}
    }
     
    
    $requested_tags = Tag::all()->whereIn('id', $tags);

    $message = $message.", "."Filtered by Tags: ";

    foreach($requested_tags as $tag){

    	$message = $message.$tag->title." ";
    }


     $result['meals'] = $meals->paginate($per_page);
     $result['message'] = $message;

     return $result;
} 

//Funkcija za provjeru ako postoji samo zahtjev za brojem jela na stranici	
function only_meals_per_page($request){

	if(!$request->category && !$request->tag && $request->per_page) {

		return true;
	}

	return false;
}


/******Moj način riješavanja pronalaska jela prema više tagova*****/

//Kreiranje prazne kolekcije, provjera za svako jelo da li sadrzava sve tagove, ako ne sadrzava varijabla $contains postavlja se u false i navedeno jelo ne sprema se u kolekciju. Navedeno riješenje sam napravio prije pronalaska boljeg rješenja na stack overflow.


//Kreiranje prazne kolekcije za spremanje jela koja zadovoljavaju uvjet
	/*$filtered_meals = collect();
	$result = array();
	$message = "Tags: ";
	
	//Jela koja zadovoljavaju prvi tag
	
	$meals = Meal::whereHas('tags', function ($tags) use($tag) {
    $tags->where('meal_tag.tag_id', $tag[0]);
	})->get();

	$arr_length = count($tag);

	//Pregledavanje svih jela koja zadovoljavaju prvi tag, da li zadovoljavaju i ostale
	
	foreach($meals as $meal){
		$contains = true;
		for($i=1; $i<$arr_length; $i++){
			
		if($meal->tags->contains($tag[$i]) == false){

				$contains = false;
			}
		}

		if($contains == true){ $filtered_meals->push($meal); }

	}*/