<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('index');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Localization
Route::get('locale/{locale}', [LocalizationController::class, 'setLocale'])->name('locale.set');

// Categories
Route::controller(CategoryController::class)->group(function () {
  Route::group(['prefix' => 'categories', 'as' => 'categories.', 'middleware' => 'auth'], function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
  });
});

// Articles
Route::controller(ArticleController::class)->group(function () {
  Route::group(['prefix' => 'articles', 'as' => 'articles.', 'middleware' => 'auth'], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
  });
});

// Articles Comments
Route::post('/comments/store/{articleId}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
