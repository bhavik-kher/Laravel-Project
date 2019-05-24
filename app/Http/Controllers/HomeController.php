<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->get();
        foreach($articles as $key => $article){
            $totleLikeDislikes = getTotalLikeDislikes($article->id);
            $articles[$key]['likes'] =  $totleLikeDislikes['likes'];
            $articles[$key]['dislikes'] =  $totleLikeDislikes['dislikes'];
            if(! \Auth::check()){
                $articles[$key]['blocked'] = false;
                $articles[$key]['liked'] = false;
                $articles[$key]['disliked'] = false;
            }else{
                $articles[$key]['blocked'] = isThisArticleBlocledByUser($article->id,\Auth::user()->id);
                $likedordisliked = isArticleLikedOrDislikedByUser($article->id,\Auth::user()->id);
                $articles[$key]['liked'] = $likedordisliked['liked'];
                $articles[$key]['disliked'] = $likedordisliked['disliked'];
            }
        }
        return view('home',compact('articles'));
    }
}
