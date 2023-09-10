<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\UesrsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController ;
use App\Http\Controllers\PostController as ControllersPostController;
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


Route::get('/', [ControllersPostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [ControllersPostController::class, 'create'])->name('posts.create');
Route::post('posts/store', [ControllersPostController::class, 'store'])->name('posts.store');
Route::get('posts/{id}', [ControllersPostController::class, 'show'])->name('posts.show');
Route::get('posts/{id}/edit', [ControllersPostController::class, 'edit'])->name('posts.edit');
Route::patch('posts/{id}/update', [ControllersPostController::class, 'update'])->name('posts.update');
Route::delete('posts/{id}/delete', [ControllersPostController::class, 'destroy'])->name('posts.destroy');


Route::post('/fetch-data', [ControllersPostController::class, 'fetchData'])->name('pagination.fetch_data');
Route::post('/categories/{category_id}/fetch-data', [ControllersPostController::class, 'fetchCategoriesData']);
Route::post('/authors/{author_id}/fetch-data', [ControllersPostController::class, 'fetchAuthorsData']);

Route::get('/categories/{id}', [ControllersPostController::class, 'category'])->name('posts.category');
Route::get('/authors/{id}', [ControllersPostController::class, 'author'])->name('posts.author');





//Route::resource('posts', ControllersPostController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-posts', [ControllersPostController::class, 'myPosts'])->name('posts.myPosts');
    // route prfix admin
    Route::prefix('admin')->group(function () {

        // create route for users
        Route::get('users', [UesrsController::class, 'index'])->name('admin.users.index');
        Route::post('users', [UesrsController::class, 'index'])->name('admin.users.index');
        Route::get('users/create', [UesrsController::class, 'create'])->name('admin.users.create');
        Route::post('users/store', [UesrsController::class, 'store'])->name('admin.users.store');
        Route::get('users/{user}/edit', [UesrsController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}/update', [UesrsController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}/destroy', [UesrsController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('users/{user}/show', [UesrsController::class, 'show'])->name('admin.users.show');

        Route::resource('categories', CategoryController::class);
        Route::any('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::resource('posts', PostController::class)->names([
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'show' => 'admin.posts.show',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'destroy' => 'admin.posts.destroy',
        ]);
        Route::any('/posts', [PostController::class, 'index'])->name('admin.posts.index');
        Route::get('posts/filterByCategory/{id}', [PostController::class, 'filterByCategory'])->name('admin.posts.filterByCategory');
        Route::get('posts/filterByAuthor/{id}', [PostController::class, 'filterByAuthor'])->name('admin.posts.filterByAuthor');
        // Route delete post
        Route::delete('posts/deletePost/{id}', [PostController::class, 'deletePost'])->name('admin.posts.deletePost');
    });




});

require __DIR__.'/auth.php';
