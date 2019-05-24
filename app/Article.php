<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_title','article_description', 'article_image', 'article_tags','user_id'
    ];

	public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function getArticleImageAttribute($value){
    	$image = ($value) ? ($value) : 'noimage.png'; 
    	return $image; 
    }
    
}
