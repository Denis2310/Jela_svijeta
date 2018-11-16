<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Category extends Model
{
    public $translatedAttributes = ['title'];

    public function meals(){

    	return $this->hasMany('App\Meal'); //Dohvatiti jela preko kategorije!!!
    }
}
