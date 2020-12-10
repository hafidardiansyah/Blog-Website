<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index']);

Route::get('posts/create', [PostController::class, 'create']);
Route::post('posts/save', [PostController::class, 'save']);

Route::get('posts/{post:slug}/edit', [PostController::class, 'edit']);
Route::patch('posts/{post:slug}/update', [PostController::class, 'update']);

Route::delete('posts/{post:slug}/delete', [PostController::class, 'delete']);

Route::get('categories/{category:slug}', [CategoryController::class, 'show']);
Route::get('tags/{tag:slug}', [TagController::class, 'show']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);
