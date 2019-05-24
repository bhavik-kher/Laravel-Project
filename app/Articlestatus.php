<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articlestatus extends Model
{
 	protected $table = 'articles_status';
    protected $fillable = ['userid', 'articleid', 'likes', 'dislikes', 'blocked'];
}
