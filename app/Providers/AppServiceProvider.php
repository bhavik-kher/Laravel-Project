<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('categories', \App\Category::all());
        });

        view()->composer('layouts.sidebar',function($view){
            $view->with(['latestArticles'=> \App\Article::latest()->limit(3)->get(),
                'categories'=> \App\Category::all()
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
     require_once __DIR__ . '/../helper.php';
    }
}
