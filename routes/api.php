<?php

use App\Http\Controllers\Dashboard\Api\CatalogController;
use App\Http\Controllers\Dashboard\Api\CategoryController;
use App\Http\Controllers\Dashboard\Api\ChapterController;
use App\Http\Controllers\Dashboard\Api\UserController;
use App\Models\Catalog;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/proba', function () {
    dd('qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq');
});

Route::get('/uuu', function () {
    dd('uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
})->middleware('auth');

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('get_category/{category}', [CategoryController::class, 'getCategory'])->name('get.category');

    Route::post('/get_list_catalog', [CatalogController::class, 'getList'])->name('get.list.catalog');
    Route::post('/get_title_catalog/{id}', function ($id) {
        return Catalog::find($id)->title;
    });

    Route::post('/get_list_chapter', [ChapterController::class, 'getList'])->name('get.list.chapter');
    Route::post('/get_title_chapter/{id}', function ($id) {
        return Chapter::find($id)->title;
    });

    Route::post('/get_user/{user}', [UserController::class, 'getUser'])->name('get.user');
    Route::post('/update_user', [UserController::class, 'updateUser'])->name('update.user');

});
