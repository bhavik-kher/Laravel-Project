<?php
use App\Articlestatus;

	function getTotalLikeDislikes($articleid){
        $likes = Articlestatus::where('articleid','=',$articleid)->where('likes','=','1')->count();
        $dislikes = Articlestatus::where('articleid','=',$articleid)->where('dislikes','=','1')->count();
        return ['likes'=>$likes,'dislikes'=>$dislikes];
    }

   	function isThisArticleBlocledByUser($articleid,$userid){
        // dd($userid);
        $isBlocked = Articlestatus::where('articleid','=',$articleid)->where('userid','=',$userid)->where('blocked','=','1')->first();
        // dd($isBlocked);
        return (( $isBlocked ) ? true : false) ;
    }

   	function isArticleLikedOrDislikedByUser($articleid,$userid){
        $liked = Articlestatus::where('userid','=',$userid)->where('articleid','=',$articleid)->where('likes','=','1')->first();
        $disliked = Articlestatus::where('userid','=',$userid)->where('articleid','=',$articleid)->where('dislikes','=','1')->first();
        return [ 'liked' => (($liked) ? true : false),
                 'disliked' => (($disliked) ? true : false),
                ];
    }