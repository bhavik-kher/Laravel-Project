<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            
            @if(isset($latestArticles) && count($latestArticles) > 0)
            @foreach($latestArticles as $article)
            <a href="{{url('articles/'.$article->id.'/show')}}">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="{{asset('article_images').'/'.$article->article_image}}" alt="article image" class="img-fluid"></div>
                    <div class="title"><strong>{{$article->article_title}}</strong>
                        <div class="d-flex align-items-center">
                            <div class="views">{{$article->created_at->diffForHumans() }}</div>
                            <div class="comments">{{$article->user->full_name}}</div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            
            
            @endif
            
        </div>
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
        <header>
            <h3 class="h6">Categories</h3>
        </header>
        @if(isset($categories) && count($categories) > 0)
            @foreach($categories as $categorie)
                <div class="item d-flex justify-content-between"><a href="#">{{ $categorie->title}}</a></div>
            @endforeach
        @endif
    </div>
    <!-- Widget [Tags Cloud Widget]-->
    {{-- <div class="widget tags">
        <header>
            <h3 class="h6">Tags</h3>
        </header>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
            <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
            <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
            <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
            <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
        </ul>
    </div> --}}
</aside>