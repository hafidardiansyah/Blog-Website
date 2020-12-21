<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('search', [SearchController::class, 'post'])->name('search.post');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');

Route::prefix('posts')->middleware(['auth'])->group(function () {
    Route::get('create', [PostController::class, 'create']);
    Route::post('save', [PostController::class, 'save']);

    Route::get('my-post/{user_id:slug}', [PostController::class, 'my_post']);
    Route::get('{post:slug}/edit', [PostController::class, 'edit']);
    Route::patch('{post:slug}/update', [PostController::class, 'update']);

    Route::delete('{post:slug}/delete', [PostController::class, 'delete']);
});

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('categories/{category:slug}', [CategoryController::class, 'show']);
Route::get('tags/{tag:slug}', [TagController::class, 'show']);

Auth::routes();

Route::get('/', [PostController::class, 'index'])->name('posts.index');
