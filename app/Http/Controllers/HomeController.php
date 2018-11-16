<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Meal;
use App\Category;
use App\Tag;

class HomeController extends Controller
{
    
    public function index() {

    	$meals = Meal::paginate(5);
    	$filter_categories = Category::all();
        $filter_tags = Tag::all();
        
        return view('index', compact('meals', 'filter_categories', 'filter_tags'));
    }
}
