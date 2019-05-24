<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use Illuminate\Http\Request;
use App\Articlestatus;
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $articles = $user->articles;
        foreach($articles as $key => $article){
            $totleLikeDislikes = getTotalLikeDislikes($article->id);
            $articles[$key]['likes'] =  $totleLikeDislikes['likes'];
            $articles[$key]['dislikes'] =  $totleLikeDislikes['dislikes'];
            
            $articles[$key]['blocked'] = isThisArticleBlocledByUser($article->id,\Auth::user()->id);
            $likedordisliked = isArticleLikedOrDislikedByUser($article->id,\Auth::user()->id);
            $articles[$key]['liked'] = $likedordisliked['liked'];
            $articles[$key]['disliked'] = $likedordisliked['disliked'];
        }
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'article_title' => 'required|string|min:5|max:255',
            'article_description' => 'required|string|min:5|max:10000',
            'article_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|string|distinct",
        ]);

        $article_title = Article::where('article_title',$request->article_title)->first();
        if($article_title){
            $validator = \Validator::make([], []);
            $validator->errors()->add('article_title', 'Article Title already exits');
                return redirect()->back()
                                -> withErrors($validator)
                                -> withInput();
        }else{
            if ($request->hasFile('article_image')) {
                $image = $request->file('article_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/article_images');
                $image->move($destinationPath, $imageName);
            }
            $article = Article::create([
                'article_title' => $request->article_title,
                'article_description' => $request->article_description,
                'article_image' => empty($imageName) ? null : $imageName,
                'article_tags' => $request->article_tags,
                'user_id' => \Auth::id()
            ]);
            $categories = $request->categories;
            if(count($categories)){
                foreach($categories as $id){
                    $article->categories()->attach($id);
                }
            }
            return redirect('/')->with('success','Article Created');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // $article = Article::findOrFail();
        $totleLikeDislikes = getTotalLikeDislikes($article->id);
        $article['likes'] =  $totleLikeDislikes['likes'];
        $article['dislikes'] =  $totleLikeDislikes['dislikes'];
        $article['blocked'] = isThisArticleBlocledByUser($article->id,\Auth::user()->id);
        $likedordisliked = isArticleLikedOrDislikedByUser($article->id,\Auth::user()->id);
        $article['liked'] = $likedordisliked['liked'];
        $article['disliked'] = $likedordisliked['disliked'];
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // dd($article->id);
        $article->categoryArray = Article::find($article->id)->categories()->pluck('id')->toArray();
        // $article->categoryArray = $article->categories()->pluck('id')->toArray();
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
         $this->validate($request, [
            'article_title' => 'required|string|min:5|max:255',
            'article_description' => 'required|string|min:5|max:10000',
            'article_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|string|distinct",
        ]);
         $article_title = Article::where('article_title',$request->article_title)->where('article_title','<>',$request->article_title)->first();
        if($article_title){
            $validator = \Validator::make([], []);
            $validator->errors()->add('article_title', 'Article Title already exits');
                return redirect()->back()
                                -> withErrors($validator)
                                -> withInput();
        }else{
            if ($request->hasFile('article_image')) {
                $image = $request->file('article_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/article_images');
                $image->move($destinationPath, $imageName);
                
                $article->article_image = $imageName;
            }
            $article->article_title = $request->article_title;
            $article->article_description = $request->article_description;
            $article->article_tags = $request->article_tags;

            $categories = $request->categories;
            // dd($categories);
            if(count($categories)){
                foreach($categories as $id){
                    $catExists = \DB::table('article_category')->where('article_id', '=', $article->id)->where('category_id', '=', $id)->get();
                    if(! count($catExists)){
                        $article->categories()->attach($id);
                    }
                }
            }
            $article->save();
            return redirect('/articles')->with('success','Article updated');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/articles')->with('success','Successfully deleted the Article');
    }

    public function showArticlebyCategory($categoryid){

    }

    public function articleAction(Request $request){
        $action = $request->action;
        $articleid = $request->articleid;
        $isAlreadyLiked = false;
        $isAlreadyDisliked = false;

        if($action == 'like'){
            #find if already liked or not
            #if liked then redirect back 
            
            $liked = Articlestatus::where('userid','=',\Auth::user()->id)->where('articleid','=',$articleid)->where('likes','=','1')->first();
            if(!$liked){
                Articlestatus::create([
                    'userid' => \Auth::user()->id,
                    'articleid' => $articleid,
                    'likes' => '1'
                ]);
            }else{
                $isAlreadyLiked = true;
            }
            #find if this article disliked by current user
            #if disliked then remove it
            $disliked = Articlestatus::where('userid','=',\Auth::user()->id)->where('articleid','=',$articleid)->where('dislikes','=','1')->first();
            if($disliked){
                Articlestatus::where('id','=',$disliked->id)->delete();
            }
            $totleLikeDislikes = getTotalLikeDislikes($articleid);
            $resData = [
                'success' => true,
                'likes' => $totleLikeDislikes['likes'],
                'dislikes' => $totleLikeDislikes['dislikes'],
                'isAlreadyLiked' => $isAlreadyLiked
            ];  
            return response()->json($resData);

        }elseif($action == 'dislike'){
            $disliked = Articlestatus::where('userid','=',\Auth::user()->id)->where('articleid','=',$articleid)->where('dislikes','=','1')->first();
            if(!$disliked){
                Articlestatus::create([
                    'userid' => \Auth::user()->id,
                    'articleid' => $articleid,
                    'dislikes' => '1'
                ]);
            }else{
                $isAlreadyDisliked = true;
            }
            #find if this article disliked by current user
            #if disliked then remove it
            $liked = Articlestatus::where('userid','=',\Auth::user()->id)->where('articleid','=',$articleid)->where('likes','=','1')->first();
            if($liked){
                Articlestatus::where('id','=',$liked->id)->delete();
            }
            $totleLikeDislikes = getTotalLikeDislikes($articleid);
            $resData = [
                'success' => true,
                'likes' => $totleLikeDislikes['likes'],
                'dislikes' => $totleLikeDislikes['dislikes'],
                'isAlreadyDisliked' => $isAlreadyDisliked
            ];  
            return response()->json($resData);

        }
    }
}
