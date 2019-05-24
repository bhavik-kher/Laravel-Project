@extends('layouts.master')



@section('content')
	<div class="container">
    <div class="row justify-content-center mt-5">
{{-- {{dd($article)}} --}}
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Update Article') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('article.update', $article->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}


                        <div class="form-group row">
                            <label for="article_title" class="col-md-4 col-form-label text-md-right">{{ __('Article Title') }}</label>

                            <div class="col-md-6">
                                <input id="article_title" type="text" class="form-control{{ $errors->has('article_title') ? ' is-invalid' : '' }}" name="article_title" value="{{ (old('article_title')) ? old('article_title') : $article->article_title }} " required autofocus>

                                @if ($errors->has('article_title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('article_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="article_description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                        		<textarea class="form-control {{ $errors->has('article_description') ? ' is-invalid' : '' }}" id="article_description" name="article_description"rows="3" required>{{ (old('article_description')) ? old('article_description'):$article->article_description }}</textarea>

                                @if ($errors->has('article_description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('article_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <div class="article_img_preview text-center">
                                <div class="post-thumbnail"><img src="{{asset('article_images').'/'.$article->article_image}}" alt="article image" class="img-fluid" style="max-width: 200px"></div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="form-group row">
						    <label for="article_image" class="col-md-4 col-form-label text-md-right">{{ __('Update Image') }}</label>
						    <div class="col-md-6">
						    	<input type="file" class="form-control form-control-file" name="article_image" id="article_image">
						    </div>	
						  </div>

						<div class="form-group row">
						    <label for="article_tags" class="col-md-4 col-form-label text-md-right {{ $errors->has('article_tags') ? ' is-invalid' : '' }}">{{ __('Add Tags') }}</label>
						    <div class="col-md-6">
						    	<input type="text" class="form-control" name="article_tags" id="article_tags" data-role="tagsinput" value="{{(old('article_tags')) ? old('article_tags'): $article->article_tags}}">
                                @if ($errors->has('article_tags'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('article_tags') }}</strong>
                                    </span>
                                @endif
						    </div>	
						  </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Choose Categories') }}</label>

                            <div class="col-md-6">
                                <select id="categories" class="form-control" name="categories[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ (old('categories') ? (in_array($category->id,old('categories')) ? "selected" : "" ) : (in_array($category->id,$article->categoryArray) ? "selected" : "" ) )}} >
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('categories'))
                                    <span class="" style="color:red; font-weight: 700;width: 100%;margin-top: .25rem;font-size: 80%;
    color: #dc3545;}">
                                        <strong>{{ $errors->first('categories') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Article') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection