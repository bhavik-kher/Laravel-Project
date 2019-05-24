@extends('layouts.master')
@section('content')
	<div class="container">
		<div class="row">
		<!-- Latest Posts -->
			<main class="post blog-post col-lg-8">
				<div class="container">
					<div class="post-single">
						<div class="post-thumbnail"><img src="{{asset('article_images').'/'.$article->article_image}}" alt="article image" class="img-fluid"></div>
						<div class="post-details">
							{{-- <div class="post-meta d-flex justify-content-between">
								<div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
							</div> --}}
							<h1>{{$article->article_title}}</h1>
							<div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
								{{-- <div class="avatar"></div> --}}
								<div class="title"><span>{{$article->user->full_name}}</span></div></a>
								<div class="d-flex align-items-center flex-wrap">
									<div class="date"><i class="icon-clock"></i> {{$article->updated_at->diffForHumans() }}</div>
									{{-- <div class="views"><i class="icon-eye"></i> 500</div> --}}
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
								</div>
							</div>
							<div class="post-body">
								<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							</div>
							{{-- <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div> --}}
						</div>
					</div>			
				</div>
			</main>
		@include('layouts.sidebar')
		</div>
	</div>
@endsection



