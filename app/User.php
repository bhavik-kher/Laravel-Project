<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'phone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getFullNameAttribute($value){
        return  $this->first_name .' '. $this->last_name;
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    // public function getArticles()
    // {
    //     return $this->hasMany('App\Article', 'user_id', 'id');
    // }
}
