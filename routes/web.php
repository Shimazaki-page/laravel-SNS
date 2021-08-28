<?php

use App\Http\Controllers;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::resource('/articles', Controllers\ArticleController::class)->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', Controllers\ArticleController::class)->only(['show']);
Route::prefix('articles')->name('articles.')->group(function (){
    Route::put('/{article}/like',[Controllers\ArticleController::class,'like'])->name('like')->middleware('auth');
    Route::delete('/{article}/like',[Controllers\ArticleController::class,'unlike'])->name('unlike')->middleware('auth');
});
