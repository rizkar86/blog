<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class CategoriesComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', function ($view) {
            $usersWithMostPosts = User::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
            $categoriesWithMostPosts = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
            $view->with(compact('categoriesWithMostPosts', 'usersWithMostPosts'));


        });
    }
}
