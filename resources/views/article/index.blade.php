@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <main class="posts-listing col-lg-8">
                <div class="row">
                    <!-- Article -->
                    @if(isset($articles) && count($articles) > 0)
                        @foreach($articles as $article)
                                <div class="post col-xl-6">
                                    <div class="articles" id="{{$article->id}}">
                                        <div class="post-thumbnail">
                                            <a href="javascript:;"><img src="{{asset('article_images').'/'.$article->article_image}}" alt="article image" class="img-fluid"></a>
                                        </div>
                                        <div class="post-details">
                                            <div class="post-meta d-flex justify-content-between">
                                                <div class="date meta-last">{{$article->created_at->toFormattedDateString()}}</div>
                                            <div class="category">@if($article->categories)
                                                @foreach($article->categories as $category)
                                                    <a href="#">{{$category->title}}</a>
                                                @endforeach 
                                            @endif</div>
                                            </div>
                                            <a href="{{'articles/'.$article->id.'/show'}}">
                                                <h3 class="h4">{{$article->article_title}}</h3>
                                            </a>
                                            <p class="text-muted">{{$article->article_description}}</p>

                                            <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                                                <div class="title"><span>{{$article->user->full_name}}</span></div></a>
                                                <div class="date"><i class="icon-clock"></i>{{$article->created_at->diffForHumans() }}</div>
                                                <div class="comments meta-last">
                                                <ul class="menu-content">
                                                    <li title="like"><a href="javascript:;" id="likes_{{$article->id}}" action="like"
                                                            class="fa @if($article->liked) {{'fa-thumbs-up'}} @else {{'fa-thumbs-o-up'}} @endif articleAction likes"
                                                            articleid="{{$article->id}}"><span>{{$article->likes}}</span></a></li>
                                                    <li title="dislike"><a href="javascript:;" id="dislikes_{{$article->id}}" action="dislike"
                                                            class="fa @if($article->disliked) {{'fa-thumbs-up'}} @else {{'fa-thumbs-o-down'}} @endif articleAction dislikes"
                                                            articleid="{{$article->id}}"><span>{{$article->dislikes}}</span></a></li>
                                                </ul>
                                            </div>
                                            </footer>
                                        </div>
                                    </div>
                                    @if (Auth::check())
                                        <div class="buttonEdit">
                                            <a href="{{url('articles/'.$article->id.'/edit')}}" class="btn btn-sm btn-primary"> 
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                            </a>
                                        </div>
                                        <div class="buttonDelete">
                                            <form action="{{ route('article.destroy', [$article->id])}}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-sm btn-danger " type="submit">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>  
                        @endforeach
                    @else
                        <div class="post col-xl-9">
                            <div class="text-center">No Article Published Yet</div>
                        </div>
                    @endif
                </div>
            </main>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection

@section('custom_script')
    
@endsection