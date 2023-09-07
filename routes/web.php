<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\UesrsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController ;
use App\Http\Controllers\Auth\PostController as ControllersPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::post('/fetch-data', [BlogController::class, 'fetchData'])->name('pagination.fetch_data');
Route::post('/categories/{category_id}/fetch-data', [BlogController::class, 'fetchCategoriesData']);
Route::post('/authors/{author_id}/fetch-data', [BlogController::class, 'fetchAuthorsData']);
Route::get('/posts/{id}', [BlogController::class, 'post'])->name('blog.post');
Route::get('/categories/{id}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/authors/{id}', [BlogController::class, 'author'])->name('blog.author');





//Route::resource('posts', ControllersPostController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/posts', ControllersPostController::class);
    Route::get('/my-posts', [ControllersPostController::class, 'myPosts'])->name('blog.myPosts');
    // route prfix admin
    Route::prefix('admin')->group(function () {
        Route::any('/users', [UesrsController::class, 'index'])->name('users.index');
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::get('posts/filterByCategory/{id}', [PostController::class, 'filterByCategory'])->name('posts.filterByCategory');
        Route::get('posts/filterByAuthor/{id}', [PostController::class, 'filterByAuthor'])->name('posts.filterByAuthor');
        // Route delete post
        Route::delete('posts/deletePost/{id}', [PostController::class, 'deletePost'])->name('posts.deletePost');
    });




});

require __DIR__.'/auth.php';
