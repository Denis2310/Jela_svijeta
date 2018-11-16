<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Meal extends Model
{   

    /*use Translatable;*/

    /*public $translatedAttributes = ['title', 'description'];
    public $translationModel = 'App\MealTranslation';*/
    

    //Jelo pripada jednoj kategoriji
    public function category(){

    	return $this->belongsTo('App\Category');
    }

    public function ingredients(){

    	return $this->belongsToMany('App\Ingredient')->withTimestamps();;
    }

    public function tags(){

    	return $this->belongsToMany('App\Tag')->withTimestamps();;
    }
}