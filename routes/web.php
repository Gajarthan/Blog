<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Models\Posts;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[PostsController::class,'home']);
Route::resource('/admin/posts',PostsController::class)->middleware('auth');
Route::resource('/admin/categories',CategoriesController::class)->middleware('auth');
Route::get('/checkslug/{title}', function ($title) {
    return SlugService::createSlug(Posts::class,'slug',$title);
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

