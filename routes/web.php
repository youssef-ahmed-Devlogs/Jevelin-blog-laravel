<?php

use App\Http\Controllers\ArticleAlbumController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Http\Request;
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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('index');
Auth::routes();

// Localization
Route::get('locale/{locale}', [LocalizationController::class, 'setLocale'])->name('locale.set');

// Articles
Route::controller(ArticleController::class)->group(function () {
  Route::group(['prefix' => 'articles', 'as' => 'articles.', 'middleware' => ['auth', 'role:user|admin']], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
  });
});

// Articles Comments
Route::post('/comments/store/{articleId}', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');


Route::post('upload', [ArticleAlbumController::class, 'upload']);
Route::delete('upload', [ArticleAlbumController::class, 'cancel']);
