<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// Categories
Route::controller(CategoryController::class)->group(function () {
  Route::group(['prefix' => 'dashboard/categories', 'as' => 'dashboard.categories.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');

    Route::get('/', 'index')->name('index');

    Route::get('/{category_id}/edit', 'edit')->name('edit');
    Route::patch('/{category_id}', 'update')->name('update');

    Route::delete('/{category_id}', 'destroy')->name('destroy');
  });
});
