<?php

use Illuminate\Support\Facades\Route;

// use App\Models\User;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
// use App\Http\Controllers\Dashboard\CatalogController;
use App\Http\Controllers\Dashboard\BrandController;
// use App\Http\Controllers\Dashboard\ChapterController;
// use App\Models\Catalog;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SlidesController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListCategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\DimensionController;

Route::get('/poligon/category', function (Request $request) {
    $categories = Category::with('children')->orderBy('sort')->orderBy('id')->get()->toTree()->toArray();

    dump($categories);
    dd('code');

});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/category/{slug}', [ListCategoryController::class, 'index'])->name('category.index');

// Route::get('/catalog', [ListCatalogController::class, 'index'])->name('index.catalog');
// Route::get('/catalog/{slug}', [ListCatalogController::class, 'chapter'])->name('index.catalog.chapter');
// Route::get('/catalog/{catalog_slug}/{chapter_slug}', [ListCatalogController::class, 'category'])->name('index.catalog.chapter.category');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard/Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    // Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('auth.login');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])->name('auth.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Auth/Profile');
    })->name('auth.profile');

    Route::get('/account', function () {
        return Inertia::render('Auth/Account');
    })->name('auth.account');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Dashboard');
    })->name('dashboard.dashboard');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');

    // Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    // ->middleware(['signed', 'throttle:6,1'])
    // ->name('verification.verify');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Dashboard');
    })->middleware('verified')->name('dashboard.dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('slides', SlidesController::class)->except(['show', 'edit', 'create']);
        Route::resource('brand', BrandController::class)->except(['show', 'edit', 'create']);
        Route::resource('color', ColorController::class)->except(['show', 'edit', 'create']);
        Route::resource('dimension', DimensionController::class)->except(['show', 'edit', 'create']);



        
        // Route::resource('chapter', ChapterController::class)->except(['index', 'edit', 'create']);
        // Route::resource('category', CategoryController::class)->except(['edit']);

        Route::get('category/{category}', [CategoryController::class, 'index'])->name('category.index');
        Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('category/append/{category}', [CategoryController::class, 'append'])->name('category.append');
        Route::post('category/create/{category}', [CategoryController::class, 'create'])->name('category.create');
        Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::post('category/proba/{category}', [CategoryController::class, 'proba'])->name('category.proba');

        Route::resource('users', UserController::class);
    });
});
