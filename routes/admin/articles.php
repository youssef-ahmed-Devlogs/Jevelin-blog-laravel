<?php

use App\Http\Controllers\Admin\ArticleController;
use Illuminate\Support\Facades\Route;

// Articles
Route::controller(ArticleController::class)->group(function () {
  Route::group(['prefix' => 'dashboard/articles', 'as' => 'dashboard.articles.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');

    Route::get('/edit', 'edit')->name('edit');
    Route::patch('/', 'update')->name('update');

    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
  });
});
