<?php

use App\Enums\RoleEnum;
use App\Enums\RoleNameEnum;
use App\Http\Controllers\ProfileController;
use App\Models\Catalog;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get('/dashboard', function () {

//     return Inertia::render('Dashboard/Dashboard');

// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/poligon.php';
