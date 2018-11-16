<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{   
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    

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