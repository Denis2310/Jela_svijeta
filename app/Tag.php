<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class Tag extends Model
{
	public $translatedAttributes = ['title'];

    public function meals(){

    	return $this->belongsToMany('App\Meal')->withTimestamps();;
    }
}
