<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('articles', 'ArticleController@index');
Route::get('articles/{article}/show', 'ArticleController@show');
Route::get('articles/{article}/edit', 'ArticleController@edit');
Route::put('articles/update/{article}', 'ArticleController@update')->name('article.update');
Route::get('articles/create', 'ArticleController@create');
Route::post('articles/store', 'ArticleController@store');
Route::delete('/article/{article}', 'ArticleController@destroy')->name('article.destroy');
Route::post('articles/action','ArticleController@articleAction');
Route::get('profile/edit','ProfileController@edit')->name('user.profile.edit');
Route::put('profile/update/{user}','ProfileController@update')->name('user.profile.update');
// Route::group(['middleware' => 'web'], function () {
//  Route::delete('/home/destroy',[
//   'as'=> 'home.destroy',
//   'uses'=> 'homeController@destroy',
//  ]);
// });
