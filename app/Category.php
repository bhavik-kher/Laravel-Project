<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title'
    ];


    public function getAllCategory(){
    	$categories = $this->all();
    	return empty($categories) ? [] : $categories;
    }
}
